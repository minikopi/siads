<?php

namespace App\Http\Controllers;

use App\Helpers\Condition;
use App\Helpers\JsonData;
use App\Helpers\Midtrans;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Mahasantri;
use App\Models\PaymentType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(?string $id = null)
    {
        $data = [];
        if (Auth::user()->role == 'Mahasantri') {
            $siswa = Mahasantri::with('class')->findOrFail(Auth::user()->mahasantri->id);
        } else {
            $siswa = Mahasantri::with('class')->findOrFail($id);
        }

        $type = PaymentType::get();
        for ($i = 1; $i <= 8; $i++) {
            $comData = [
                "semester" => $i,
                "status" => Condition::CheckStatuPayment($siswa->class->current_semaster, $i)
            ];
            $payment_type = [];
            foreach ($type as $t) {
                $code = str_replace(" ", "-", $t->name);
                $id = $code . '-' . $i;
                $TotalPayment = DetailInvoice::where('semester', $i)->where('payment_type_id', $t->id)->whereHas('invoice', function ($q) use ($siswa) {
                    $q->where('status', 2);
                    $q->where('mahasantri_id', $siswa->id);
                })->sum('nominal');
                $statusLast = $TotalPayment >= $t->nominal ? 2 : 1;
                $tx = [
                    'id' => $id,
                    'type' => $t->name,
                    'pyment_id' => $t->id,
                    'type_code' => $t->type,
                    'code' => $code,
                    'status_text' =>
                    JsonData::PaymentStatus()[$statusLast],
                    'status_code' => $statusLast,
                    'total' => $t->nominal,
                    'sudah_dibayar' => $TotalPayment,
                ];
                $payment_type[] = $tx;
            }
            $comData['payment_type'] = $payment_type;
            $data[] = $comData;
        }
        $currentDateTime = Carbon::now();

        $token['invoice'] = Invoice::where('mahasantri_id', $siswa->id)->where('status', 1)->where('expired_at', '>', $currentDateTime)->first();
        $token['url'] = env('MIDTRANS_URL');
        $token['clienKey'] = env('MIDTRANS_CLIENTKEY');
        return view('payment.index', compact('data', 'token'));
    }

    public function PaymentSend(Request $request)
    {
        // dd($request->all());
        $currentDateTime = Carbon::now();
        $token = Invoice::where('mahasantri_id', Auth::user()->mahasantri->id)->where('status', 1)->where('expired_at', '>', $currentDateTime)->first();
        if ($token != null) {
            return back()->with('error', 'Ada tagihan yang belum di bayarkan!');
        }

        DB::beginTransaction();
        try {

            $inv = Invoice::Create([
                "invoice_code" => Invoice::generateTransactionNumberGroup(),
                "mahasantri_id" => Auth::user()->mahasantri->id,
                "status" => 1,
                "total" => array_sum($request->value),
                "expired_at" => $currentDateTime->addDays(2)
            ]);
            $item = [];
            foreach ($request->paymentJenis as $key => $j) {
                $data = json_decode($j, true);
                // dd($data);
                $payment = PaymentType::findOrFail($data['payment_type']);
                if ($request->value[$key] == 0 || $request->value[$key] == null) {
                    return back();
                }
                array_push($item, array(
                    'id'                => $payment->id,
                    'price'         => $request->value[$key],
                    'quantity'  => 1,
                    'name'          => $payment->name . '-' . $data['semester']

                ));
                DetailInvoice::create([
                    'invoice_id' => $inv->id,
                    'payment_type_id' => $payment->id,
                    'semester' => $data['semester'],
                    'nominal' => $request->value[$key],
                    'name_payment' => $payment->name,
                ]);
            }
            $set = Midtrans::GetSpapToken($inv, $item);
            $inv->update([
                'snap_token' => $set
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalahan!');
        }
        DB::commit();
        return back()->with('successe', 'Berhasil!');
    }
}
