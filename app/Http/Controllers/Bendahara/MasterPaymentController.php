<?php

namespace App\Http\Controllers\Bendahara;

use App\Helpers\Formater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bendahara\MasterPaymentStore;
use App\Http\Requests\Bendahara\MasterPaymentUpdate;
use App\Models\Mahasantri;
use App\Models\Payment;
use App\Models\PaymentType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class MasterPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mahasantri $mahasantri)
    {
        return view('bendahara.payment-master.index', [
            'mahasantri' => $mahasantri
        ]);
    }

    public function data($mahasantri_id)
    {
        $mahasantri = Mahasantri::findOrFail($mahasantri_id);
        $data = Payment::query()
            ->with('payment_type')
            ->select('payments.id', 'payments.semester', 'payments.installment', 'payments.discount', 'payments.total', 'payments.paid', 'payments.created_at', 'payments.mahasantri_id', 'payments.due_date', 'payment_types.name')
            ->join('payment_types', 'payment_types.id', '=', 'payments.payment_type_id')
            ->orderBy('payments.semester')
            ->where('mahasantri_id', $mahasantri_id)
            ->latest();

        return DataTables::of($data)
            ->editColumn('discount', function ($data) {
                $s = Formater::RupiahCurrency($data->discount);
                return $s;
            })
            ->editColumn('total', function ($data) {
                $s = Formater::RupiahCurrency($data->total);
                return $s;
            })
            ->editColumn('installment', function ($data) {
                return $data->installment ? 'Ya' : 'Tidak';
            })
            ->editColumn('due_date', function ($data) {
                return $data->due_date->format('d F Y');
            })
            ->addColumn('action', function ($data) use ($mahasantri) {
                return view('bendahara.payment-master.button', compact('data', 'mahasantri'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mahasantri $mahasantri)
    {
        return view('bendahara.payment-master.create', [
            'mahasantri' => $mahasantri,
            'payment_types' => PaymentType::orderByDesc('nominal')->select('id', 'name', 'nominal')->where('academic_year_id', $mahasantri->academic_year_id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterPaymentStore $request, Mahasantri $mahasantri)
    {
        try {
            DB::beginTransaction();

            // check
            $check = Payment::firstWhere([
                'mahasantri_id' => $mahasantri->getKey(),
                'academic_year_id' => $mahasantri->academic_year_id,
                'payment_type_id' => $request->payment_type_id,
                'installment' => $request->installment,
                'semester' => $request->semester,
                'total' => $request->total,
            ]);
            if ($check) {
                throw new Exception('Poin pembayaran tidak boleh dobel');
            }

            // store
            $payment = new Payment();
            $payment->mahasantri_id = $mahasantri->getKey();
            $payment->semester = $request->semester;
            $payment->academic_year_id = $mahasantri->academic_year_id;
            $payment->payment_type_id = $request->payment_type_id;
            $payment->installment = $request->installment;
            $payment->due_date = $request->due_date;
            $payment->total = $request->total;
            $payment->discount = $request->discount;
            $payment->note = $request->note;
            $payment->created_by = $request->user()->name;
            $payment->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'store master payment - ' . $mahasantri->nama_lengkap,
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }

        return to_route('bendahara.master-payment.payment.index', [$mahasantri])->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasantri $mahasantri)
    {
        return view('bendahara.payment-master.index', [
            'mahasantri' => $mahasantri
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasantri $mahasantri, Payment $payment)
    {
        return view('bendahara.payment-master.edit', [
            'mahasantri' => $mahasantri,
            'payment' => $payment,
            'payment_types' => PaymentType::orderByDesc('nominal')->select('id', 'name', 'nominal')->where('academic_year_id', $mahasantri->academic_year_id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasterPaymentUpdate $request, Mahasantri $mahasantri, Payment $payment)
    {
        try {
            DB::beginTransaction();

            /**
             * Ketika sudah tidak ada tagihan atau lunas, maka akan error jika
             * nominal baru lebih kecil dari pada nominal lama.
             */
            if ($payment->outstanding == 0 && $request->total < $payment->total) {
                throw new Exception('Tidak bisa diubah karena biaya sudah dilunasi');
            }

            // Jika masih ada tagihan
            if ($payment->outstanding > 0) {
                // batalkan jika jumlah tagihan (total - discount) lebih kecil dari yang sudah dibayar
                $tagihan = $request->total - $request->discount;
                if ($tagihan < $payment->paid) {
                    throw new Exception('Total tagihan (nominal - potongan) tidak boleh kurang dari ' . number_format($payment->paid, 0, ',', '.'));
                }
            }

            // check
            $check = Payment::query()
                ->where([
                    'mahasantri_id' => $mahasantri->getKey(),
                    'academic_year_id' => $mahasantri->academic_year_id,
                    'payment_type_id' => $request->payment_type_id,
                    'installment' => $request->installment,
                    'semester' => $request->semester,
                    'total' => $request->total,
                ])
                ->where('id', '!=', $payment->getKey())
                ->first();
            if ($check) {
                throw new Exception('Poin pembayaran tidak boleh dobel');
            }

            // update
            $payment->semester = $request->semester;
            $payment->payment_type_id = $request->payment_type_id;
            $payment->installment = $request->installment;
            $payment->due_date = $request->due_date;
            $payment->total = $request->total;
            $payment->discount = $request->discount;
            $payment->note = $request->note;
            $payment->updated_by = $request->user()->name;
            $payment->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'update master payment - ' . $mahasantri->nama_lengkap,
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }

        return to_route('bendahara.master-payment.payment.index', [$mahasantri])->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasantri $mahasantri, Payment $payment)
    {
        try {
            DB::beginTransaction();
            if ($payment->mahasantri()->isNot($mahasantri)) {
                throw new Exception('Tidak dapat melakukan hal ini', 403);
            }

            if ($payment->paid > 0) {
                throw new Exception('Tidak dapat menghapus biaya yang terdapat transaksi', 403);
            }

            $payment->deleted_by = request()->user()->name;
            $payment->save();

            $payment->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                ['msg' => $th->getMessage()],
                $th->getCode()
            );
        }

        return response()->json(
            [
                'msg' => 'Berhasil menghapus data',
                'redirect' => route('bendahara.master-payment.payment.index', $mahasantri)
            ]
        );
    }
}
