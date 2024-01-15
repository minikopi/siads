<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Classes;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsentController extends Controller
{
    public function index()
    {
        return view('absent.index');
    }

    public function detail($id)
    {
        $data['class'] = Classes::findOrFail($id);
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        return view('absent.detail', compact('data'));
    }

    public function AbsentAdmin($id)
    {
        $data['schedule'] = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($id);
        $data['absen'] = Absent::getSummeryByData($id);
        // dd($data['schedule']->class->nama);
        return view('absent.absent', compact('data'));
    }

    public function AbsentForm($id)
    {
        $data['schedule'] = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($id);
        $data['siswa'] = Mahasantri::where('kelas_id', $data['schedule']->class->id)->orderBy('nama_depan', "ASC")->get();
        // dd($data['schedule']->class->nama);
        return view('absent.formAbsent', compact('data'));
    }

    public function store($schedule_id, Request $request)
    {
        $schedule = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($schedule_id);
        DB::beginTransaction();
        // dd($request->all());
        foreach ($request->siswa as $key => $s) {
            try {
                Absent::create([
                    'schedule_id' => $schedule_id,
                    'mahasiswa_id' => $key,
                    'tanggal' => Carbon::parse(
                        $request->tanggal_pelajaran
                    ),
                    'status' => $s
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        DB::commit();
        return redirect()->route('absent.AbsentAdmin', ['id' => $schedule_id])->with('success', 'Absen Berhasil Dibuat!');
    }
}
