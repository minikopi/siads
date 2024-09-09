<?php

namespace App\Http\Controllers\Mahasantri;

use App\Helpers\Condition;
use App\Helpers\JsonData;
use App\Helpers\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Mahasantri;
use App\Models\PaymentType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if (! $user->hasRole(Role::Mahasantri)) {
            return to_route('dashboard.index');
        }

        $siswa = Mahasantri::with('class')->findOrFail($user->mahasantri->id);

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
        return view('payment.mahasantri', compact('data', 'token'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice_code = Invoice::generateTransactionNumberGroup();
        $currentDateTime = Carbon::now();
        $token = Invoice::where('mahasantri_id', Auth::user()->mahasantri->id)->where('status', 1)->where('expired_at', '>', $currentDateTime)->first();
        if ($token != null) {
            return back()->with('error', 'Ada tagihan yang belum dibayarkan!');
        }

        DB::beginTransaction();
        try {

            $inv = Invoice::Create([
                "invoice_code" => $invoice_code,
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
            $set = Midtrans::GetPaymentUrl($inv, $item);
            $inv->update([
                'payment_url' => $set
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage(), [
                'action' => 'payment',
                'user_id' => auth()->id(),
                'actor' => Role::Mahasantri,
            ]);
            return back()->with('error', 'Terjadi Kesalahan!');
        }
        DB::commit();
        return back()->with('successe', 'Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
