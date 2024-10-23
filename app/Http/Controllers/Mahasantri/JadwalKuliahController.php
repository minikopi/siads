<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $id = Auth::user()->mahasantri->kelas_id;
        $data['class'] = Classes::findOrFail($id);
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');

        return view('mahasantri-section.schedule.index', compact('data'));
    }

    public function data(Request $request, $id)
    {
        $data = Schedule::with('mata_kuliah', 'dosen.user', 'class')
            ->where('class_id', $id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas('mata_kuliah', function ($b) use ($request) {
                    $b->where('smester', $request->smester);
                });
            })
            ->orderByDesc('day');

        return DataTables::of($data)
            ->addColumn('jadwal', function ($data) {
                if ($data->mata_kuliah->sks != 0) {
                    $start = Carbon::parse($data->start_date)->translatedFormat('H:i');
                    $end = Carbon::parse($data->end_date)->translatedFormat('H:i');
                    return $data->day . ' ' . $start . '-' . $end . ' ' . $data->place;
                } else {
                    return 'Pelaksanaan Dilaksanakan Diakhir Semester';
                }
            })
            ->addColumn('peserta', function ($data) {
                $peserta = Mahasantri::where('kelas_id', $data->class->id)->count();
                return $peserta;
            })
            ->rawColumns(['jadwal'])
            ->addIndexColumn()
            ->make(true);
    }

    public function print($id, ?int $semester = 1)
    {
        $kelas = Classes::where('id', $id)->first();
        $schedule = Schedule::with("mata_kuliah", "dosen.user", 'class')
            ->where('class_id', $id)
            ->whereHas('mata_kuliah', function ($query) use ($semester) {
                $query->where('smester', $semester);
            })
            ->orderByDesc('day')
            ->get();
        $data = [
            'nama' => Auth::user()->name,
            'nim' => Auth::user()->mahasantri->nim,
            'angkatan' => $kelas->nama,
            'semester' => $semester,
            'tahun_akademik' => $kelas->tahun_ajaran,
            'musyrif_pa' => 'Ahmad Shodiqol Umam',
            'schedule' => $schedule,
            'total_sks' => $schedule->sum('sks')
        ];

        $pdf = Pdf::loadView('mahasantri-section/schedule/print', $data);
        return $pdf->download(str()->slug('KRS - ' . Auth::user()->name) . '.pdf');
    }
}
