<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Classes;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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

    public function AbsentMahasiswa(Request $request)
    {
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');

        return view('absent.mahasiswaView.absent', compact('data'));
    }

    public function generatePDF()
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->download('document.pdf');
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

    public function update($schedule_id, Request $request)
    {
        $schedule = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($schedule_id);
        DB::beginTransaction();
        // dd($request->all());
        foreach ($request->siswa as $key => $s) {
            try {
                Absent::where('id', $key)->update([
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
        return redirect()->route('absent.AbsentAdmin', ['id' => $schedule_id])->with('success', 'Absen Berhasil DiEdit!');
    }

    public function AbsentFormEdit($id, $date)
    {
        $data['schedule'] = Schedule::with("mata_kuliah", "dosen.user", 'class')->findOrFail($id);
        $data['siswa'] = Mahasantri::where('kelas_id', $data['schedule']->class->id)->orderBy('nama_depan', "ASC")->get();
        $data['absent'] = Absent::where('schedule_id', $id)->where('tanggal', $date)->get();
        // dd($data['absent']->where('mahasiswa_id', 7)->first()->status);
        // dd($a);
        // foreach ($a as $as) {
        //     dd($as['mahasiswa_id']);
        // }
        return view('absent.formAbsentEdit', compact('id', 'date', 'data'));
    }

    public function DeleteAbsent($id, $date)
    {
        $data['absent'] = Absent::where('schedule_id', $id)->where('tanggal', $date)->delete();
        return redirect()->route('absent.AbsentAdmin', ['id' => $id])->with('success', 'Absen Berhasil Didelete!');
    }
}
