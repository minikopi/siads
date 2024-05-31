<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        // $lakilakiCount = Mahasantri::where('jenis_kelamin', 'laki-laki')->count();
        // $perempuanCount = Mahasantri::where('jenis_kelamin', 'perempuan')->count();
        return view('schedule.index');
    }

    public function detail($id)
    {
        $data['class'] = Classes::findOrFail($id);
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        return view('schedule.detail', compact('data'));
    }

    public function generatePDF($id)
    {
        $kelas = Classes::where('id', $id)->first();
        $schedule = Schedule::with("mata_kuliah", "dosen.user", 'class')
            ->where('class_id', $id)
            ->whereHas('mata_kuliah', function ($query) {
                $query->where('smester', 2);
            })
            ->get();
        $data = [
            'nama' => Auth::user()->name,
            'nim' => Auth::user()->mahasantri->nim,
            'angkatan' => $kelas->nama,
            'semester' => $kelas->current_semaster,
            'tahun_akademik' => $kelas->tahun_ajaran,
            'musyrif_pa' => 'Ahmad Shodiqol Umam',
            'schedule' => $schedule,
            'total_sks' => $schedule->sum('sks')
        ];

        $pdf = Pdf::loadView('schedule.cetak', $data);
        return $pdf->download('KRS - ' . Auth::user()->name . '.pdf');
    }
}
