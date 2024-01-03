<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index()
    {
        return view('mata-kuliah.index');
    }

    public function dataGet()
    {
        $data = MataKuliah::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('mata-kuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'sks'           => 'required|integer',
            'kode'          => 'required|unique:mata_kuliahs',
            'smester'          => 'required',
        ], [
            'nama.required'     => 'Nama Mata Kuliah diperlukan',
            'sks.required'    => 'Total SKS diperlukan',
            'sks.integer' => 'Total SKS harus berupa angka',
            'kode.unqique'    => 'Kode Mata Kuliah sudah diterdaftar',
            'kode.required' => 'Kode Mata Kuliah diperlukan',
            'smester.required' => 'smester Mata Kuliah diperlukan',
        ]);

        MataKuliah::create([
            'nama'  => $request->nama,
            'kode'  => $request->kode,
            'sks'   => $request->sks,
            'smester'   => $request->smester,
        ]);

        return redirect()->route('mata-kuliah.index')->with('success', 'Data Mata Kuliah Berhasil Dibuat!');
    }
}
