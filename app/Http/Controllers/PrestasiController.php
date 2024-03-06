<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PrestasiController extends Controller
{
    public function index()
    {
        return view('prestasi.index');
    }

    public function dataGet()
    {
        $data = Prestasi::all();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('nim', function ($data) {
                return $data->mahasantri->nim;
            })
            ->editColumn('nama', function ($data) {
                return $data->mahasantri->nama_depan . ' ' . $data->mahasantri->nama_belakang;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
