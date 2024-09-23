<?php

namespace App\Http\Controllers;

use App\Helpers\Condition;
use App\Helpers\JsonData;
use App\Helpers\Midtrans;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Models\Mahasantri;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use App\Helpers\Generator as HelpersGenerator;

class PaymentController extends Controller
{
    public function index(?string $id = null)
    {
        if (request()->has('order_id') && !request()->has('status_code') && !request()->has('transaction_status')) {
            // ini void
            $this->destroy(base64_encode(request('order_id')), $id);
        }
        if (request()->has('order_id') && request()->has('status_code') && request()->has('transaction_status')) {
            // ini void
            if (request('status_code') === '407' && request('transaction_status') === 'expire') {
                $this->destroy(base64_encode(request('order_id')), $id);
            }
        }
        // if (request()->has('order_id') && request()->has('status_code') && request()->has('transaction_status')) {
        //     // ini paid
        //     if (request('status_code') === '200' && request('transaction_status') === 'settlement') {
        //         $this->paid(base64_encode(request('order_id')), $id); # belum ada method-nya
        //     }
        // }

        $data = [];
        $siswa = Mahasantri::with('class')->findOrFail($id);

        $token['invoice'] = Invoice::with('details')->where('mahasantri_id', $siswa->id)->where('status', Invoice::Pending)->first();

        $total = DB::table('payments')
            ->select(DB::raw("sum(`total`) as invoice, sum(`paid`) as paid, sum(`outstanding`) as unpaid"))
            ->where('mahasantri_id', $id)
            ->first();

        $payments = Payment::query()
            ->with('payment_type')
            ->where('mahasantri_id', $id)
            ->orderBy('semester')
            ->orderByDesc('total')
            ->get();

        return view('payment.index', compact('payments', 'total', 'token', 'siswa'));
    }

    public function PaymentSend(Request $request)
    {
        $payment = Payment::with('mahasantri.class')->findOrFail($request->payment_id[0]);

        // dd($payment->mahasantri_id);

        $lastInvoiceGroup = \App\Models\Invoice::where('mahasantri_id', $payment->mahasantri_id)->whereMonth('created_at', date('n'))->whereYear('created_at', date('Y'))->latest()->first();
        $roman = HelpersGenerator::numberToRoman(date('n'));
        $randomString = substr(str_shuffle('ABCDEFGHJKMNPQRSTUVWXYZ234567'), 0, 5);
        $name = strtoupper(str($payment->mahasantri->nama_depan)->slug());
        $nunmberGroup = 'INV/' . $name . '/' . $randomString . '/' .  $roman . '/' . date('y');
        $numberNow = '0001';
        if (isset($lastInvoiceGroup)) {
            $men = explode('-', $lastInvoiceGroup->invoice_code);
            $numberNow = sprintf("%04s", $men[1] + 1);
        }
        $invoice_code = $nunmberGroup . '-' . $numberNow;
        $currentDateTime = Carbon::now();

        $token = Invoice::where('mahasantri_id', $payment->mahasantri_id)->where('status', Invoice::Pending)->first();
        if ($token != null) {
            return back()->with('error', 'Ada tagihan yang belum dibayarkan!');
        }

        DB::beginTransaction();
        try {
            $inv = Invoice::create([
                "invoice_code" => $invoice_code,
                "mahasantri_id" => $payment->mahasantri_id,
                "status" => Invoice::Paid,
                "total" => array_sum($request->nominal),
                'payment_url' => $request->getUri(),
                'payment_type' => 'cash',
                'merchant_name' => Auth::user()->name,
                'merchant_number' => Auth::id(),
                'transaction_status' => 'settlement',
                'fraud_status' => 'accept'
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
                    'semester' => $payment->mahasantri->class->current_semaster,
                    'nominal' => $request->nominal[$key],
                    'name_payment' => $payment_name,
                ]);

                // update data payment
                $payment->paid = $payment->paid + $request->nominal[$key];
                $payment->save();
            }

            if (count($item) < 1) {
                throw new \Exception('Tidak ada tagihan yang harus dibayar.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage(), [
                'action' => 'payment',
                'user_id' => auth()->id(),
                'actor' => Role::Admin,
            ]);
            return back()->with('error', 'Terjadi Kesalahan! ' . $e->getMessage());
        }
        DB::commit();
        return back()->with('success', 'Berhasil!');
    }

    public function ListSiswa()
    {
        return view('ViewDefault.siswa.siswa');
    }
    public function ListSiswaData()
    {
        $data = Mahasantri::with('class')->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('nama', function ($data) {
                $types = $data->nama_depan . ' ' . $data->nama_belakang;
                return $types;
            })
            ->addColumn('action', function ($data) {
                return view('ViewDefault.siswa.button', compact('data'));
            })
            ->rawColumns(['action', 'nama'])
            ->make(true);
    }

    public function destroy(string $id, string $mahasantri_id)
    {

        $invoice = Invoice::firstWhere([
            'invoice_code' => base64_decode($id),
            'status' => Invoice::Pending,
            'mahasantri_id' => $mahasantri_id,
        ]);

        if ($invoice) {
            $invoice->status = Invoice::Void;
            $invoice->save();
        }
    }
}
