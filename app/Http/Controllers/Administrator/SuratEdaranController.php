<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\SuratEdaranStore;
use App\Http\Requests\Administrator\SuratEdaranUpdate;
use App\Models\Edaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SuratEdaranController extends Controller
{
    public function index()
    {
        return view('admin-section.kalender-akademik.index');
    }
    
    public function data()
    {
        $data = Edaran::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
            return view('admin-section.surat-edaran.button', compact('data'));
            })
            ->editColumn('file', function ($data) {
                return asset('storage/' . $data->file);
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::parse($data->tanggal)->translatedFormat('d F Y');
            })
            ->rawColumns(['action', 'file'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        return view('admin-section.surat-edaran.create');
    }

    public function store(SuratEdaranStore $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('edaran');
            $data = array_merge($data, [
                'file' => $filePath,
            ]);
        }
        Edaran::create($data);

        return redirect()->route('administrator.akademik.index')->with('success', 'Data Surat Edaran Berhasil Dibuat!');
    }

    public function edit(Edaran $edaran)
    {
        return view('admin-section.surat-edaran.edit', [
            'data' => $edaran
        ]);
    }

    public function update(SuratEdaranUpdate $request, Edaran $edaran)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('edaran');
            $data = array_merge($data, [
                'file' => $filePath,
            ]);
        }
        $edaran->update($data);

        return redirect()->route('administrator.akademik.index')->with('success', 'Data Surat Edaran Berhasil Diubah!');
    }

    public function destroy(Edaran $edaran)
    {
        try {
            DB::beginTransaction();

            Storage::delete($edaran->file);

            $edaran->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                ['msg' => $th->getMessage()],
                $th->getCode()
            );
        }

        return response()->json(
            [
                'msg' => 'Berhasil menghapus data',
                'redirect' => route('administrator.akademik.index')
            ]
        );
    }
}
