<?php

namespace App\Http\Controllers;

use App\Helpers\Formater;
use App\Helpers\JsonData;
use App\Http\Requests\Master\PaymentTypePublish;
use App\Http\Requests\Master\PaymentTypeStore;
use App\Http\Requests\Master\PaymentTypeUpdate;
use App\Jobs\PublishPaymentType;
use App\Jobs\RepublishPaymentType;
use App\Models\AcademicYear;
use App\Models\Mahasantri;
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
            ->editColumn('published', function ($data) {
                $s = $data->published ? 'Ya' : 'Belum';
                return $s;
            })
            ->editColumn('due_date', function ($data) {
                return $data->due_date->format('d F Y');
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
    }

    public function publish($id)
    {
        $data = PaymentType::with('academic_year')->find($id);
        $count = Mahasantri::where([
            'academic_year_id' => $data->academic_year_id
        ])->count();

        return view('master-pembayaran.publish', compact('data', 'count'));
    }

    public function publishing(PaymentTypePublish $request, $id)
    {
        try {
            DB::beginTransaction();
            $paymentType = PaymentType::with('academic_year')->where('published', false)->where('id', $id)->first();
            if (!$paymentType && $request->replace == 1) {
                $paymentType = PaymentType::with('academic_year')->find($id);
                RepublishPaymentType::dispatch($paymentType, auth()->user()->name)->afterResponse();
            } else {
                PublishPaymentType::dispatch($paymentType, auth()->user()->name)->afterResponse();
                $paymentType->update([
                    'published' => true
                ]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }

        DB::commit();
        return redirect()->route('paymentType.index')->with('success', 'Berhasil menerbitkan pembayaran!');
    }
}
