<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index()
    {
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        return view('mata-kuliah.index', compact('data'));
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

    public function jsonMatkul(Request $request)
    {
        if ($request->smester == '') {
            $data = "Pilih smester terlebih dahulu";
            return response()->json(array(), 200);
        }
        $data = MataKuliah::where("smester", $request->smester)->get();
        return response()->json($data, 200);
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

    public function edit($id)
    {
        $data = MataKuliah::findOrFail($id);
        return view('mata-kuliah.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = MataKuliah::findOrFail($id);
        $request->validate([
            'nama'          => 'required',
            'sks'           => 'required|integer',
            'kode'          => 'required|unique:mata_kuliahs,kode,' . $data->id,
            'smester'          => 'required',
        ], [
            'nama.required'     => 'Nama Mata Kuliah diperlukan',
            'sks.required'    => 'Total SKS diperlukan',
            'sks.integer' => 'Total SKS harus berupa angka',
            'kode.unqique'    => 'Kode Mata Kuliah sudah diterdaftar',
            'kode.required' => 'Kode Mata Kuliah diperlukan',
            'smester.required' => 'smester Mata Kuliah diperlukan',
        ]);

        $data->update($request->all());
        return redirect()->route('mata-kuliah.index')->with('success', 'Data Mata Kuliah Berhasil Diupdate!');
    }

    public function delete($id)
    {
        $data = MataKuliah::findOrFail($id);
        $data->delete();
        return redirect()->route('mata-kuliah.index')->with('success', 'Data Mata Kuliah Berhasil Dihapus!');
    }
}
