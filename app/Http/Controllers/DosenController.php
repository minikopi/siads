<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    public function index()
    {
        $dosenCount = Dosen::where('tipe', 'Dosen')->count();
        $musyrifCount = Dosen::where('tipe', 'Musyrif')->count();
        return view('dosen.index', compact('dosenCount', 'musyrifCount'));
    }

    public function dataGet()
    {
        $data = Dosen::where('tipe', 'Dosen')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('nama', function ($data) {
                return $data->user->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataGet2()
    {
        $data = Dosen::where('tipe', 'Musyrif')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('nama', function ($data) {
                return $data->user->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'email'         => 'required|unique:users',
            'nomor_induk'   => 'required|unique:dosens',
            'jabatan'       => 'required',
            'tipe'          => 'required',
        ], [
            'nama.required'     => 'Nama diperlukan',
            'email.required'    => 'Email diperlukan',
            'email.unqique'    => 'Email sudah diterdaftar',
            'nomor_induk.required' => 'Nomor Induk diperlukan',
            'nomor_induk.unique' => 'Nomor Induk sudah terdaftar',
            'jabatan.required'  => 'Jabatan diperlukan',
            'tipe.required'     => 'Tipe diperlukan',
        ]);

        $user = User::create([
            'name'      => $request->nama,
            'email'     => $request->email,
            'password'  => password_hash('password', PASSWORD_DEFAULT),
            'role'      => 'Dosen',
        ]);

        Dosen::create([
            'user_id'       => $user->id,
            'nomor_induk'   => $request->nomor_induk,
            'jabatan'       => $request->jabatan,
            'tipe'          => $request->tipe,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Dibuat!');
    }
}
