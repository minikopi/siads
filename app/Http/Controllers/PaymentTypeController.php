<?php

namespace App\Http\Controllers;

use App\Helpers\Formater;
use App\Helpers\JsonData;
use App\Http\Requests\Master\PaymentTypeStore;
use App\Http\Requests\Master\PaymentTypeUpdate;
use App\Models\AcademicYear;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PaymentTypeController extends Controller
{
    public function index()
    {
        return view('master-pembayaran.index');
    }

    public function dataGet()
    {
        $data = PaymentType::join('academic_years', 'payment_types.academic_year_id', '=', 'academic_years.id')
            ->orderByDesc('academic_years.start_year')
            ->orderByDesc('payment_types.nominal')
            ->select('payment_types.*', 'academic_years.full_year');

        return DataTables::of($data)
            ->addColumn('tipe', function ($data) {
                $types = JsonData::TypePayment();
                return $types[$data->type];
            })
            ->addColumn('nomial_format', function ($data) {
                $s = Formater::RupiahCurrency($data->nominal);
                return $s;
            })
            ->addColumn('action', function ($data) {
                return view('master-pembayaran.button', compact('data'));
            })
            ->rawColumns(['action', 'tipe', 'nomial_format'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        $data['payment_type'] = JsonData::TypePayment();
        $data['academic_years'] = AcademicYear::visible()->urut()->get();

        return view('master-pembayaran.create', compact('data'));
    }

    public function store(PaymentTypeStore $request)
    {
        try {
            DB::beginTransaction();
            PaymentType::create($request->validated());
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('paymentType.index')->with('success', 'Berhasil menambahkan data!');
    }

    public function update(PaymentTypeUpdate $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = PaymentType::findOrFail($id);
            // TODO: jika sudah di-consume oleh mahasantri, maka harus ada konfirmasi lagi
            //       karena perubahan nominal akan berefek kepada data yang sudah ada
            //       atau tidak.
            $data->update($request->validated());
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('paymentType.index')->with('success', 'Berhasil mengubah data!');
    }

    public function edit($id)
    {
        $data['model'] = PaymentType::find($id);
        $data['payment_type'] = JsonData::TypePayment();
        $data['academic_years'] = AcademicYear::visible()->urut()->get();
        return view('master-pembayaran.edit', compact('data'));
    }

    public function delete($id)
    {
        return response()->json(
            ['msg' => 'Maaf, Anda tidak dapat melakukan ini. Hubungi web administrator.'],
            400
        );
        // $data = PaymentType::findOrFail($id);
        // $data->delete();
        // return redirect()->route('paymentType.index')->with('success', 'Berhasil!');
    }
}
