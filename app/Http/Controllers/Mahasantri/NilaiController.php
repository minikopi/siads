<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');

        return view('mahasantri-section.nilai.index', compact('data'));
    }

    public function data(Request $request)
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

    public function print(Request $request)
    {
        $score = Schedule::with("score", "mata_kuliah", "dosen.user", 'class')->where("class_id", Auth::user()->mahasantri->kelas_id)
            ->when($request->id, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->semester);
                });
            })
            ->orderBy('created_at', 'desc')->get();

        $kelas = Classes::where("id", Auth::user()->mahasantri->kelas_id)->first();

        $tahun_ajaran = $kelas->tahun_ajaran;
        $current_semester = $kelas->current_semaster;
        $tahun_akademik = $this->get_tahun_akademik($tahun_ajaran, $current_semester);
        $data_musyrif = Dosen::with('user')->where('id', $kelas->musyrif_id)->first();

        $data = [
            'nama' => Auth::user()->name,
            'nim' => Auth::user()->mahasantri->nim,
            'angkatan' => $kelas->nama,
            'semester' => $request->semester,
            'tahun_akademik' => $tahun_akademik,
            'musyrif_pa' => $data_musyrif,
            'score' => $score,
            'total_sks' => $score->sum('sks')
        ];
        // dd($score);
        $pdf = Pdf::loadView('mahasantri-section.nilai.print', $data);
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
}
