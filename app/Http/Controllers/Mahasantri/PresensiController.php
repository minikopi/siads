<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Absent;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PresensiController extends Controller
{
    public function index()
    {
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');

        return view('mahasantri-section.presensi.index', compact('data'));
    }

    public function data(Request $request)
    {
        $data = Schedule::with("mata_kuliah", "dosen.user", 'class')->where("class_id", Auth::user()->mahasantri->kelas_id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->smester);
                });
            })
            ->orderBy('schedules.created_at', 'desc')->get();

        foreach ($data as $key => $val) {
            $val['total'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('schedule_id', $val->id)->count();
            $val['hadir'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'HADIR')->where('schedule_id', $val->id)->count();
            $val['sakit'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'SAKIT')->where('schedule_id', $val->id)->count();
            $val['izin'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'IZIN')->where('schedule_id', $val->id)->count();
            $val['ghoib'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'GHOIB')->where('schedule_id', $val->id)->count();
            $val['terlambat'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'TERLAMBAT')->where('schedule_id', $val->id)->count();
            $val['persent'] = ($val['total'] !== 0) ? ($val['hadir'] / $val['total']) * 100 : 0;
            // dump($val);
        }
        return DataTables::of($data)
            ->addColumn('jadwal', function ($data) {
                $start = Carbon::parse($data->start_date)->translatedFormat('H:i');
                $end = Carbon::parse($data->end_date)->translatedFormat('H:i');
                return $data->day . " " . $start . "-" . $end . " " . $data->place;
            })
            ->addColumn('peserta', function ($data) {
                $peserta = Mahasantri::where('kelas_id', $data->class->id)->count();
                return $peserta;
            })
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action', 'jadwal'])
            ->addIndexColumn()
            ->make(true);
    }
}
