<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        return view('mahasantri-section.mata-kuliah.index');
    }

    public function data()
    {
        $data = MataKuliah::query()
            ->orderBy('smester')
            ->orderBy('nama');

        $data = DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        return $data;
    }
}
