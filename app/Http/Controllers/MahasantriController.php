<?php

namespace App\Http\Controllers;

use App\Models\Mahasantri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MahasantriController extends Controller
{
    public function index()
    {
        $lakilakiCount = Mahasantri::where('jenis_kelamin', 'laki-laki')->count();
        $perempuanCount = Mahasantri::where('jenis_kelamin', 'perempuan')->count();
        return view('mahasantri.index', compact('lakilakiCount', 'perempuanCount'));
    }

    public function dataGet()
    {
        $data = Mahasantri::get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('nama', function ($data) {
                return $data->nama_depan . ' ' . $data->nama_belakang;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('mahasantri.create');
    }

    public function store(Request $request)
    {


        DB::beginTransaction();
        try {
            $user = User::create([
                'name'      => $request->nama_depan . " " . $request->nama_belakang,
                'email'     => $request->email,
                'password'  => password_hash('password', PASSWORD_DEFAULT),
                'role'      => 'Mahasantri',
            ]);
            $req = $request->all();
            $req['user_id'] = $user->id;
            $req['nim'] = '139172931';
            $req['nik'] = '139172931';
            $req['whatsapp'] = '139172931';
            $req['whatsapp_wali'] = '139172931';
            $req['status'] = 'aktif';
            Mahasantri::create($req);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data Mata Kuliah Gagal Dibuat!');
        }
        DB::commit();

        return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri Berhasil Dibuat!');
    }

    public function edit($id)
    {
        $data = Mahasantri::findOrFail($id);
        return view('mahasantri.create', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $data = Mahasantri::findOrFail($id);
        DB::beginTransaction();
        try {
            $input = $request->except(['jenis_kelamin', 'kelas_id', 'user_id']);
            $data->update($input);

            $user = User::findOrFail($data->user_id);
            $user->name = $request->nama_depan . " " . $request->nama_belakang;
            $user->email = $request->email;
            $user->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri  Berhasil Di Update!');
    }

    public function delete($id)
    {
        try {
            Mahasantri::findOrFail($id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri Berhasil Di Delete!');
    }
}
