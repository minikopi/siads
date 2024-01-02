<?php

namespace App\Http\Controllers;

use App\Models\Mahasantri;
use Illuminate\Http\Request;
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
        $req = $request->all();
        $req['user_id'] = '1';
        $req['nim'] = '139172931';
        $req['nik'] = '139172931';
        $req['whatsapp'] = '139172931';
        $req['whatsapp_wali'] = '139172931';
        $req['status'] = 'aktif';


        Mahasantri::create($req);
        return redirect()->back();
    }
}
