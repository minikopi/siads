<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        return view('mahasantri-section.dosen.index');
    }

    public function data()
    {
        $data = Dosen::with('user')
            ->where('tipe', 'Dosen')
            ->latest();

        $data = DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('mahasantri-section.dosen.button', compact('data'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data;
    }

    public function data2()
    {
        $data = Dosen::with('user')
            ->where('tipe', 'Musyrif')
            ->latest();

        $data = DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('mahasantri-section.dosen.button', compact('data'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        return $data;
    }
}
