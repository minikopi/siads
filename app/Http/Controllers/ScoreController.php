<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Classes;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    public function index()
    {
        return view('score.index');
    }

    public function detail($id)
    {
        $data['class'] = Classes::findOrFail($id);
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        return view('score.detail', compact('data'));
    }

    public function AbsentAdmin($id)
    {
        $data['schedule'] = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($id);
        $data['siswa'] = Mahasantri::where('kelas_id', $data['schedule']->class->id)->orderBy('nama_depan', "ASC")->get();
        foreach ($data['siswa'] as $val) {
            $val['total'] = Absent::Where('mahasiswa_id', $val->id)->where('schedule_id', $id)->count();
            $val['hadir'] = Absent::Where('mahasiswa_id', $val->id)->where('status', 'HADIR')->where('schedule_id', $id)->count();
            $val['nilai'] = Score::Where('mahasiswa_id', $val->id)->where('schedule_id', $id)->first();
            $val['persent'] = ($val['total'] !== 0) ? ($val['hadir'] / $val['total']) * 100 : 0;
        }
        // dd($data['schedule']->class->nama);
        return view('score.score', compact('data'));
    }

    public function AbsentMahasiswa(Request $request)
    {
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');

        return view('score.mahasiswaView.absent', compact('data'));
    }

    public function dataGetScheduleMahasiswa(Request $request)
    {
        $data = Schedule::with("mata_kuliah", "dosen.user", 'class')->where("class_id", Auth::user()->mahasantri->kelas_id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->smester);
                });
            })
            ->orderBy('created_at', 'desc')->get();
        foreach ($data as $key => $val) {
            $val['total'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('schedule_id', $val->id)->count();
            $val['hadir'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'HADIR')->where('schedule_id', $val->id)->count();
            $val['sakit'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'SAKIT')->where('schedule_id', $val->id)->count();
            $val['izin'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'IZIN')->where('schedule_id', $val->id)->count();
            $val['ghoib'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'GHOIB')->where('schedule_id', $val->id)->count();
            $val['terlambat'] = Absent::Where('mahasiswa_id', Auth::user()->mahasantri->id)->where('status', 'TERLAMBAT')->where('schedule_id', $val->id)->count();
            $val['persent'] = ($val['total'] !== 0) ? ($val['hadir'] / $val['total']) * 100 : 0;
        }
        return DataTables::of($data)
            ->addColumn('jadwal', function ($data) {
                $start = Carbon::parse($data->start_date)->format('H:i');
                $end = Carbon::parse($data->end_date)->format('H:i');
                return $data->day . " " . $start . "-" . $end . " " . $data->place;
            })
            ->addColumn('peserta', function ($data) {
                // dd($data->class->id);
                $peserta = Mahasantri::where('kelas_id', $data->class->id)->count();
                // dd($peserta);
                return $peserta;
            })
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action', 'jadwal'])
            ->make(true);
    }

    public function scoreForm($id)
    {
        $data['schedule'] = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($id);
        $data['siswa'] = Mahasantri::where('kelas_id', $data['schedule']->class->id)->orderBy('nama_depan', "ASC")->get();
        foreach ($data['siswa'] as $val) {
            $val['total'] = Absent::Where('mahasiswa_id', $val->id)->where('schedule_id', $id)->count();
            $val['hadir'] = Absent::Where('mahasiswa_id', $val->id)->where('status', 'HADIR')->where('schedule_id', $id)->count();
            $val['persent'] = ($val['total'] !== 0) ? ($val['hadir'] / $val['total']) * 100 : 0;
            $scheckScore = Score::Where('mahasiswa_id', $val->id)->where('schedule_id', $id)->first();
            $val['akademin'] = isset($scheckScore) ? $scheckScore->akademik : "";
            $val['non_akademin'] = isset($scheckScore) ? $scheckScore->non_akademik : "";
            // dd(isset($scheckScore) ? "a" : "b");
        }
        // dd($data['siswa']);
        return view('score.formScore', compact('data'));
    }

    public function store($schedule_id, Request $request)
    {
        $schedule = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($schedule_id);
        DB::beginTransaction();
        $data['siswa'] = Mahasantri::where('kelas_id', $schedule->class->id)->orderBy('nama_depan', "ASC")->get();
        foreach ($data['siswa'] as $val) {
            $val['total'] = Absent::Where('mahasiswa_id', $val->id)->where('schedule_id', $schedule_id)->count();
            $val['hadir'] = Absent::Where('mahasiswa_id', $val->id)->where('status', 'HADIR')->where('schedule_id', $schedule_id)->count();
            $val['persent'] = ($val['total'] !== 0) ? ($val['hadir'] / $val['total']) * 100 : 0;
        }
        // dd($request->all());
        foreach ($data['siswa'] as $key => $s) {
            try {
                $scheckScore = Score::Where('mahasiswa_id', $val->id)->where('schedule_id', $schedule_id)->first();
                if (isset($scheckScore)) {
                    $scheckScore->update([
                        'akademik' => $request->akademik[$s->id],
                        'non_akademik' => $request->non_akademik[$s->id]
                    ]);
                } else {
                    Score::create([
                        'schedule_id' => $schedule_id,
                        'mahasiswa_id' => $s->id,
                        'total_pelajaran' => $s->total,
                        'persentasi_kehadiran' => round($s->persent),
                        'akademik' => $request->akademik[$s->id],
                        'non_akademik' => $request->non_akademik[$s->id],
                    ]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        DB::commit();
        return redirect()->route('score.AbsentAdmin', ['id' => $schedule_id])->with('success', 'Absen Berhasil Dibuat!');
    }
}
