<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\MatkulDosen;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data['matkul'] = MataKuliah::get();
        return view('dosen.create', compact('data'));
    }

    public function dosenMatkul(Request $request)
    {
        if ($request->matkul_id == '') {
            $data = "Pilih Mata Kuliah terlebih dahulu";
            return response()->json(array(), 200);
        }
        $data = Dosen::with('matkul', 'user')->whereHas("matkul", function ($q) use ($request) {
            $q->where('matkul_id', $request->matkul_id);
        })->get();
        return response()->json($data, 200);
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

        switch (strtolower($request->tipe)) {
            case Role::Dosen:
                $user->addRole(Role::Dosen);
                break;

            case Role::Musyrif:
                $user->addRole(Role::Musyrif);
                break;

            default:
                //
                break;
        }

        $dosen = Dosen::create([
            'user_id'       => $user->id,
            'nomor_induk'   => $request->nomor_induk,
            'jabatan'       => $request->jabatan,
            'tipe'          => $request->tipe,
        ]);
        if ($request->has('matkul')) {
            foreach ($request->matkul as $v) {
                MatkulDosen::create([
                    'dosen_id' => $dosen->id,
                    'matkul_id' => $v
                ]);
            }
        }
        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Dibuat!');
    }

    public function edit($id)
    {
        $data['dosen'] = Dosen::with('matkul', 'user')->findOrFail($id);
        $data['matkul'] = MataKuliah::get();
        return view('dosen.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Dosen::with('matkul', 'user')->findOrFail($id);
        DB::beginTransaction();
        try {
            $data->update($request->except('matkul', 'nama', 'email'));
            $data->user->update([
                'name' => $request->nama,
                'email' => $request->email
            ]);
            $data->matkul()->delete();
            foreach ($request->matkul as $v) {
                MatkulDosen::create([
                    'dosen_id' => $data->id,
                    'matkul_id' => $v
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Di update!');
    }
}
