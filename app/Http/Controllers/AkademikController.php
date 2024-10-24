<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\Edaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AkademikController extends Controller
{
    public function index()
    {
        return view('akademik.index');
    }

    public function dataGet()
    {
        $data = Akademik::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('akademik.button-akademik', compact('data'));
            })
            ->editColumn('tanggal_mulai', function ($data) {
                return Carbon::parse($data->tanggal_mulai)->translatedFormat('d F Y');
            })
            ->editColumn('tanggal_akhir', function ($data) {
                return Carbon::parse($data->tanggal_akhir)->translatedFormat('d F Y');
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataGet2()
    {
        $data = Edaran::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
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

    public function createKalender()
    {
        return view('akademik.createKalender');
    }

    public function storeKalender(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'semester'      => 'required',
            'tahun_ajaran'  => 'required',
        ], [
            'nama.required'             => 'Nama diperlukan',
            'tanggal_mulai.required'    => 'Tanggal Mulai diperlukan',
            'tanggal_akhir.required'    => 'Tanggal Akhir diperlukan',
            'semester.required'         => 'Semester diperlukan',
            'tahun_ajaran.required'     => 'Tahun Ajaran diperlukan',
        ]);

        Akademik::create([
            'nama'              => $request->nama,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_akhir'     => $request->tanggal_akhir,
            'semester'          => $request->semester,
            'tahun_ajaran'      => $request->tahun_ajaran,
            'keterangan'        => $request->keterangan,
        ]);

        return redirect()->route('akademik.index')->with('success', 'Data Kalender Akademik Berhasil Dibuat!');
    }

    public function createEdaran()
    {
        return view('akademik.createEdaran');
    }

    public function storeEdaran(Request $request)
    {
        $request->validate([
            'perihal'   => 'required',
            'no'        => 'required',
            'tanggal'   => 'required',
            'file'      => 'required|file|mimes:pdf'
        ], [
            'perihal.required'  => 'Perihal diperlukan',
            'no.required'       => 'No Edaran diperlukan',
            'tanggal.required'  => 'Tanggal diperlukan',
            'file.required'     => 'File diperlukan',
            'file.mimes'        => 'File harus berformat PDF'
        ]);

        $file = $request->file('file');
        if ($file) {
            $filePath = $file->store('public/data/edaran');
        }
        $filePath = str_replace('public/', '', $filePath);

        Edaran::create([
            'nama'      => $request->perihal,
            'no'        => $request->no,
            'tanggal'   => $request->tanggal,
            'file'      => $filePath,
        ]);

        return redirect()->route('akademik.index')->with('success', 'Data Surat Edaran Berhasil Dibuat!');
    }
}
