<?php

namespace App\Http\Controllers\Mahasantri;

use App\Helpers\Condition;
use App\Helpers\JsonData;
use App\Helpers\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Mahasantri;
use App\Models\Payment;
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
        if (request()->has('order_id') && !request()->has('status_code') && !request()->has('transaction_status')) {
            // ini void
            $this->destroy(base64_encode(request('order_id')));
        }
        if (request()->has('order_id') && request()->has('status_code') && request()->has('transaction_status')) {
            // ini void
            if (request('status_code') === '407' && request('transaction_status') === 'expire') {
                $this->destroy(base64_encode(request('order_id')));
            }
        }
        // if (request()->has('order_id') && request()->has('status_code') && request()->has('transaction_status')) {
        //     // ini paid
        //     if (request('status_code') === '200' && request('transaction_status') === 'settlement') {
        //         $this->paid(base64_encode(request('order_id'))); # belum ada method-nya
        //     }
        // }

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
                    $q->where('status', Invoice::Paid);
                    $q->where('mahasantri_id', $siswa->id);
                })->sum('nominal');
                $status_text = $TotalPayment >= $t->nominal ? 'Lunas' : 'Belum lunas';
                $status_code = $TotalPayment >= $t->nominal ? 2 : 1;
                $tx = [
                    'id' => $id,
                    'type' => $t->name,
                    'pyment_id' => $t->id,
                    'type_code' => $t->type,
                    'code' => $code,
                    'status_text' => $status_text,
                    'status_code' => $status_code,
                    'total' => $t->nominal,
                    'sudah_dibayar' => $TotalPayment,
                ];
                $payment_type[] = $tx;
            }
            $comData['payment_type'] = $payment_type;
            $data[] = $comData;
        }
        $currentDateTime = Carbon::now();

        $token['invoice'] = Invoice::with('details')->where('mahasantri_id', $siswa->id)->where('status', Invoice::Pending)->first();

        $total = DB::table('payments')
            ->select(DB::raw("sum(`total`) as invoice, sum(`paid`) as paid, sum(`outstanding`) as unpaid"))
            ->where('mahasantri_id', auth()->user()->mahasantri->id)
            ->where('semester', '<=', $siswa->class->current_semaster)
            ->first();

        $payments = Payment::query()
            ->with('payment_type')
            ->where('mahasantri_id', auth()->user()->mahasantri->id)
            ->where('semester', '<=', $siswa->class->current_semaster)
            ->orderBy('semester')
            ->orderByDesc('total')
            ->get();

        return view('payment.mahasantri', compact('payments', 'total', 'token'));
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
        $token = Invoice::where('mahasantri_id', Auth::user()->mahasantri->id)->where('status', Invoice::Pending)->first();
        if ($token != null) {
            return back()->with('error', 'Ada tagihan yang belum dibayarkan!');
        }

        DB::beginTransaction();
        try {
            $inv = Invoice::create([
                "invoice_code" => $invoice_code,
                "mahasantri_id" => Auth::user()->mahasantri->id,
                "status" => Invoice::Pending,
                "total" => array_sum($request->nominal),
                "expired_at" => $currentDateTime->addHour()
            ]);
            $item = [];
            foreach ($request->payment_id as $key => $j) {
                $data = json_decode($j, true);
                $payment = Payment::with('payment_type')->findOrFail($j);
                if ($request->nominal[$key] == 0 || $request->nominal[$key] == null) {
                    continue;
                }

                $payment_name  = $payment->payment_type->name;
                $payment_name .= " ";
                $payment_name .= ($payment->semester > 0) ? "(Semester " . $payment->semester . ")" : '';

                // pembayaran melebihi tagihan
                if ($request->nominal[$key] > $payment->outstanding) {
                    throw new \Exception('Pembayaran ' . $payment_name . ' melebihi batas yang harus dibayar.');
                }

                // error jika mencoba menyicil tagihan yang harus sekali bayar
                if (!$payment->installment && $request->nominal[$key] != $payment->outstanding) {
                    throw new \Exception('Pembayaran ' . $payment_name . ' tidak bisa dicicil atau melebihi tagihan.');
                }

                array_push($item, array(
                    'id'        => $payment->payment_type_id,
                    'price'     => $request->nominal[$key],
                    'quantity'  => 1,
                    'name'      => $payment_name
                ));

                $inv->details()->create([
                    'payment_type_id' => $payment->payment_type_id,
                    'semester' => $payment->semester,
                    'nominal' => $request->nominal[$key],
                    'name_payment' => $payment_name,
                ]);
            }

            if (count($item) < 1) {
                throw new \Exception('Tidak ada tagihan yang harus dibayar.');
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
            return back()->with('error', 'Terjadi Kesalahan! ' . $e->getMessage());
        }
        DB::commit();
        return back()->with('success', 'Berhasil!');
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

    public function destroy(string $id)
    {
        $user = Auth::user();
        $data = [];

        if (! $user->hasRole(Role::Mahasantri)) {
            return to_route('dashboard.index');
        }

        $invoice = Invoice::firstWhere([
            'invoice_code' => base64_decode($id),
            'status' => Invoice::Pending,
            'mahasantri_id' => $user->mahasantri->id,
        ]);

        if ($invoice) {
            $invoice->status = Invoice::Void;
            $invoice->save();
        }
    }
}
