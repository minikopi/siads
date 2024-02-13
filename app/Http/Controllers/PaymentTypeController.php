<?php

namespace App\Http\Controllers;

use App\Helpers\Formater;
use App\Helpers\JsonData;
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
        $data = PaymentType::orderBy('created_at', 'desc')->get();

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
            ->make(true);
    }

    public function create()
    {
        $data['payment_type'] = JsonData::TypePayment();
        return view('master-pembayaran.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'type'          => 'required',
            'nominal'          => 'required',
        ], [
            'name.required'     => 'Nama Kelas Kuliah diperlukan',
            'type.required'     => 'Nama Kelas Kuliah diperlukan',
            'nominal.required'     => 'Nama Kelas Kuliah diperlukan',
        ]);

        PaymentType::create($request->all());

        return redirect()->route('paymentType.index')->with('success', 'Data Payment Type Berhasil Dibuat!');
    }

    public function update(Request $request, $id)
    {
        $data = PaymentType::findOrFail($id);
        DB::beginTransaction();
        try {
            $data->update($request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('paymentType.index')->with('success', 'Data Payment Type Berhasil Di update!');
    }

    public function edit($id)
    {
        $data['model'] = PaymentType::find($id);
        $data['payment_type'] = JsonData::TypePayment();
        return view('master-pembayaran.create', compact('data'));
    }

    public function delete($id)
    {
        $data = PaymentType::findOrFail($id);
        $data->delete();
        return redirect()->route('paymentType.index')->with('success', 'Data Payment Type Berhasil Di delete!');
    }
}
