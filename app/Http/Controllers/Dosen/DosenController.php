<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        return view('dosen-section.dosen.index');
    }

    public function data()
    {
        $data = Dosen::with('user')
            ->where('tipe', 'Dosen')
            ->latest();

        $data = DataTables::of($data)
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
            ->addIndexColumn()
            ->make(true);
        return $data;
    }
}
