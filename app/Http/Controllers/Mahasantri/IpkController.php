<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Mahasantri;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class IpkController extends Controller
{
    public function index()
    {
        return view('mahasantri-section.ipk.index');
    }

    public function data()
    {
        $mahasiswa = Mahasantri::where('user_id', Auth::user()->id)->first();
        $tahun = Classes::where('id', $mahasiswa->kelas_id)->first();
        $current_semester = $tahun->current_semaster;
        $semesters = DB::table('mata_kuliahs')->distinct()->pluck('smester');

        $results = [];
        $startYear = $tahun->tahun_ajaran;
        foreach ($semesters as $index => $semester) {

            if ($index + 1 > $current_semester) {
                break;
            }

            $scores = Score::where('mahasiswa_id', $mahasiswa->id)
                ->whereHas('schedule.mata_kuliah', function ($query) use ($semester) {
                    $query->where('smester', $semester);
                })
                ->with('schedule.mata_kuliah')
                ->get();

            $totalSks = 0;
            $totalPoints = 0;

            foreach ($scores as $score) {
                $sks = $score->schedule->mata_kuliah->sks;
                $nilai = (($score->akademik * 0.6) + ($score->non_akademik * 0.4)) * 4 / 100;;
                $totalSks += $sks;
                $totalPoints += $nilai * $sks;
            }

            $currentYear = $startYear + floor($index / 2);
            $nextYear = $currentYear + 1;
            $tahunAjaran = "$currentYear/$nextYear";
            $semesterType = ($index % 2 == 0) ? 'Ganjil' : 'Genap';

            if ($totalSks > 0) {
                $ips = $totalPoints / $totalSks;
                $results[] = [
                    'tahun' => $tahunAjaran,
                    'semester' => $semesterType,
                    'ips' => $ips,
                    'sks' => $totalSks
                ];
            } else {
                $results[] = [
                    'tahun' => $tahunAjaran,
                    'semester' => $semesterType,
                    'ips' => 'Tidak ada mata kuliah di semester ini.',
                    'sks' => 0
                ];
            }
        }

        return DataTables::of($results)
            ->addIndexColumn()
            ->make(true);
    }
}
