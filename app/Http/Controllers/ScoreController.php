<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Classes;
use App\Models\Dosen;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

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
        $data = Schedule::with("score", "mata_kuliah", "dosen.user", 'class')
            ->where("class_id", Auth::user()->mahasantri->kelas_id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->smester);
                });
            })
            ->orderBy('created_at', 'desc');

        return DataTables::of($data)
            ->editColumn('score', function ($data) {
                if (count($data->score) > 1) {
                    return $data->score[0]->akademik;
                }
                return "-";
            })
            ->editColumn('huruf', function ($data) {
                if (count($data->score) > 1) {
                    $nilai = $data->score[0]->akademik;
                    if ($nilai > 80) {
                        return "A";
                    } elseif ($nilai > 70) {
                        return "B";
                    } elseif ($nilai > 60) {
                        return "C";
                    } elseif ($nilai > 50) {
                        return "D";
                    } else {
                        return "E";
                    }
                }
                return "-";
            })
            ->addIndexColumn()
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
                        'akademik' => $request->akademik[$s->id]
                    ]);
                } else {
                    Score::create([
                        'schedule_id' => $schedule_id,
                        'mahasiswa_id' => $s->id,
                        'total_pelajaran' => $s->total,
                        'persentasi_kehadiran' => round($s->persent),
                        'akademik' => $request->akademik[$s->id]
                    ]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        DB::commit();
        return redirect()->route('score.AbsentAdmin', ['id' => $schedule_id])->with('success', 'Penilaian Berhasil Dibuat!');
    }

    public function generatePDF(Request $request)
    {
        $score = Schedule::with("score", "mata_kuliah", "dosen.user", 'class')->where("class_id", Auth::user()->mahasantri->kelas_id)
            ->when($request->id, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", 4);
                });
            })
            ->orderBy('created_at', 'desc')->get();

        $kelas = Classes::where("id", Auth::user()->mahasantri->kelas_id)->first();

        $tahun_ajaran = $kelas->tahun_ajaran;
        $current_semester = $kelas->current_semaster;
        $tahun_akademik = $this->get_tahun_akademik($tahun_ajaran, $current_semester);
        $data_musyrif = Dosen::where('id', $kelas->musyrif_id)->first();

        $data = [
            'nama' => Auth::user()->name,
            'nim' => Auth::user()->mahasantri->nim,
            'angkatan' => $kelas->nama,
            'semester' => 4,
            'tahun_akademik' => $tahun_akademik,
            'musyrif_pa' => $musyrif,
            'score' => $score,
            'total_sks' => $score->sum('sks')
        ];
        // dd($score);
        $pdf = Pdf::loadView('score.mahasiswaView.cetak', $data);
        return $pdf->download('KHS - ' . Auth::user()->name . '.pdf');
    }

    function get_tahun_akademik($tahun_ajaran, $current_semester)
    {
        $offset = intdiv($current_semester - 1, 2);

        $start_year = $tahun_ajaran + $offset;
        $end_year = $start_year + 1;

        $tahun_akademik = $start_year . '/' . $end_year;

        return $tahun_akademik;
    }

    public function dataGet(Request $request, $id)
    {
        $data = Schedule::with("mata_kuliah", "dosen.user", 'class')
            ->where("class_id", $id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->smester);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($data)
            ->addColumn('jadwal', function ($data) {
                if ($data->mata_kuliah->sks != 0) {
                    $start = Carbon::parse($data->start_date)->translatedFormat('H:i');
                    $end = Carbon::parse($data->end_date)->translatedFormat('H:i');
                    return $data->day . " " . $start . "-" . $end . " " . $data->place;
                } else {
                    return "Pelaksanaan Dilaksanakan Diakhir Semester";
                }
            })
            ->addColumn('peserta', function ($data) {
                $peserta = Mahasantri::where('kelas_id', $data->class->id)->count();
                return $peserta;
            })
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action', 'jadwal'])
            ->make(true);
    }
}
