<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class JadwalKuliahController extends Controller
{
    public function index(Request $request)
    {
        return view('dosen-section.jadwal-kuliah.index');
    }

    public function data()
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();
        $data = Schedule::with('class', 'mata_kuliah')
            ->whereHas('dosen')
            ->where('dosen_id', $dosen?->id)
            ->latest();

        $data = DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dosen-section.jadwal-kuliah.button', compact('data'));
            })
            ->rawColumns(['action', 'tipe', 'nomial_format'])
            ->addIndexColumn()
            ->make(true);
        return $data;
    }
}
