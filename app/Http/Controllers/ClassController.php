<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Dosen;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{
    public function index()
    {
        return view('kelas.index');
    }

    public function dataGet()
    {
        $data = Classes::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function jsonClass(Request $request)
    {
        if ($request->gender == '') {
            $data = "Pilih Jenis terlebih dahulu";
            return response()->json(array(), 200);
        }
        $data = Classes::where("gender", $request->gender)->get();
        return response()->json($data, 200);
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'tahun_ajaran'          => 'required',
            'gender'          => 'required',
        ], [
            'nama.required'     => 'Nama Kelas Kuliah diperlukan',
            'tahun_ajaran.required'     => 'Nama Kelas Kuliah diperlukan',
            'gender.required'     => 'Nama Kelas Kuliah diperlukan',
        ]);

        Classes::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data Kelas Berhasil Dibuat!');
    }

    public function detail($id)
    {
        $data['class'] = Classes::findOrFail($id);
        return view("kelas.detail", compact('data'));
    }

    public function createSchedule($id)
    {

        $data['class'] = Classes::findOrFail($id);
        $data['dosen'] = Dosen::with("user")->get();
        $data['matkul'] = MataKuliah::get();
        $data['days'] = array('Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu');
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        $data['type'] = $data['class']->gender == 'Perempuan' ? array('Banat', 'Banin/Banat') : array('Banin', 'Banin/Banat');
        // dd($data["matkul"]);
        return view("kelas.matkulPerKelas.create", compact('data'));
    }

    public function storeSchedule($id, Request $request)
    {
        $request->validate([
            'mata_kuliah_id'          => 'required',
            'dosen_id'          => 'required',
            'day'          => 'required',
            'start_date'          => 'required',
            'end_date'          => 'required',
            'place'          => 'required',
        ], [
            'mata_kuliah_id.required'     => 'Mata Kuliah diperlukan',
            'dosen_id.required'     => 'Dosen diperlukan',
            'day.required'     => 'Hari diperlukan',
            'start_date.required'     => 'Waktu Mulai diperlukan',
            'end_date.required'     => 'Waktu Selesai diperlukan',
            'place.required'     => 'Tempat diperlukan',
        ]);
        $req = $request->all();
        $req['class_id'] = $id;
        Schedule::create($req);
        // dd($data["matkul"]);
        return redirect()->route('kelas.detail', ['id' => $id])->with('success', 'Jadwal Matkul Berhasil Dibuat!');
    }

    public function dataGetSchedule(Request $request, $id)
    {
        $data = Schedule::with("mata_kuliah", "dosen.user", 'class')->where("class_id", $id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->smester);
                });
            })
            ->orderBy('created_at', 'desc')->get();

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

    public function updateCurrentSmester()
    {
        // dd('aaaa');
        $data = Classes::where('current_semaster', '<', 8)->get();
        // dd($data);
        $data->each(function ($class) {
            $class->update(['current_semaster' => $class->current_semaster + 1]);
        });
        return redirect()->route('kelas.index')->with('success', 'Data Smester Berhasil Di update!');
    }
}
