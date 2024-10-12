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
        $data = Invoice::with('mahasantri.class', 'details.payment_type')
            ->latest();

        $data = DataTables::of($data)
            ->editColumn('status', function ($data) {
                switch ($data->status) {
                    case Invoice::Pending:
                        $class = 'bg-default';
                        $text = Invoice::Pending;
                        break;

                    case Invoice::Paid:
                        $class = 'bg-success';
                        $text = Invoice::Paid;
                        break;

                    case Invoice::Void:
                        $class = 'bg-dark';
                        $text = Invoice::Void;
                        break;

                    default:
                        $class = 'bg-danger';
                        $text = 'Undefined';
                        break;
                }
                return sprintf('<span class="badge %s">%s</span>', $class, $text);
            })
            ->editColumn('total', function ($data) {
                $s = Formater::RupiahCurrency($data->total);
                return $s;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->translatedFormat('d F Y - H:i');
            })
            ->addColumn('nama_angkatan', function ($data) {
                return sprintf('%s - %s', $data->mahasantri->class->nama, $data->mahasantri->class->tahun_ajaran);
            })
            ->addColumn('via', function ($data) {
                $metode = $data->payment_type ?  $data->payment_type : '';
                $oleh = $data->merchant_name ? $data->merchant_name : '';
                return $metode . ' ' . strtoupper($oleh);
            })
            ->addColumn('action', function ($data) {
                return view('bendahara.payment-history.button', compact('data'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
