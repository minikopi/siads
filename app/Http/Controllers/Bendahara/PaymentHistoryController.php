<?php

namespace App\Http\Controllers\Bendahara;

use App\Helpers\Formater;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bendahara.payment-history.index');
    }

    public function data()
    {
        $data = Invoice::with('mahasantri', 'details.payment_type')
            ->select('invoices.*', 'mahasantris.nama_lengkap')
            ->join('mahasantris', 'mahasantris.id', '=', 'invoices.mahasantri_id')
            ->orderBy('invoices.status')
            ->latest();

        return DataTables::of($data)
            ->editColumn('total', function ($data) {
                $s = Formater::RupiahCurrency($data->total);
                return $s;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d F Y - H:i');
            })
            ->addColumn('via', function ($data) {
                $metode = $data->payment_type ?  $data->payment_type : '';
                $oleh = $data->merchant_name ? $data->merchant_name : '';
                return $metode . ' ' . $oleh;
            })
            ->addColumn('action', function ($data) {
                return view('bendahara.payment-history.button', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
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
        //
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
