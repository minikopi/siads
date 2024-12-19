<?php

namespace App\Http\Controllers;

use App\Http\Requests\Administrator\KelasStore;
use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Dosen;
use App\Models\Mahasantri;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ClassController extends Controller
{
    public function index()
    {
        return view('kelas.index');
    }

    public function dataGet()
    {
        $data = Classes::with('dosen.user')->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
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
        $musyrif = Dosen::with('user')->where('tipe', 'Musyrif')->get();

        return view('kelas.create', compact('musyrif'));
    }

    public function store(KelasStore $request)
    {
        try {
            DB::beginTransaction();
            $class = Classes::create($request->validated());

            // ambil academic_years
            $academic_year = AcademicYear::where([
                'start_year' => $request->tahun_ajaran
            ])->first();
            if (!$academic_year) {
                $academic_year = AcademicYear::create([
                    'start_year' => $request->tahun_ajaran,
                    'end_year' => $request->tahun_ajaran + 1
                ]);
            }
            $class->academic_year_id = $academic_year->getKey();
            $class->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', $th->getMessage());
        }

        return redirect()->route('kelas.index')->with('success', 'Data Kelas Berhasil Dibuat!');
    }

    public function detail($id)
    {
        $data['class'] = Classes::findOrFail($id);

        return view("kelas.detail", compact('data'));
    }

    public function destroy($id)
    {
        $updt = Classes::findOrFail($id);
        $updt->delete();
        return redirect()->back()->with('success', 'Kelas Berhasil Dihapus!');
    }

    public function createSchedule($id)
    {

        $data['class'] = Classes::findOrFail($id);
        $data['dosen'] = Dosen::with("user")->get();
        $data['matkul'] = MataKuliah::get();
        $data['days'] = array('Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu');
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        $data['type'] = $data['class']->gender == 'Perempuan' ? array('Banat', 'Banin/Banat') : array('Banin', 'Banin/Banat');

        return view("kelas.matkulPerKelas.create", compact('data'));
    }

    public function storeSchedule($id, Request $request)
    {
        $request->validate([
            'mata_kuliah_id'          => 'required',
            'dosen_id'          => 'required',
        ], [
            'mata_kuliah_id.required'     => 'Mata Kuliah diperlukan',
            'dosen_id.required'     => 'Dosen diperlukan',
        ]);
        $req = $request->all();
        $req['class_id'] = $id;
        Schedule::create($req);
        // dd($data["matkul"]);
        return redirect()->route('kelas.detail', ['id' => $id])->with('success', 'Jadwal Matkul Berhasil Dibuat!');
    }

    public function dataGetSchedule(Request $request, $id)
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

    public function editSchedule($id)
    {
        $data['schedule'] = Schedule::findOrFail($id);
        $data['class'] = Classes::findOrFail($data['schedule']->class_id);
        $data['dosen'] = Dosen::with("user")->get();
        $data['matkul'] = MataKuliah::get();
        $data['days'] = array('Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu');
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        // dd($data['smester']);
        $data['type'] = $data['class']->gender == 'Perempuan' ? array('Banat', 'Banin/Banat') : array('Banin', 'Banin/Banat');

        // dd($data["matkul"]);
        return view("kelas.matkulPerKelas.edit", compact('data'));
    }

    public function updateSchedule($id, Request $request)
    {
        $updt = Schedule::findOrFail($id);
        $updt->update([
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'dosen_id' => $request->dosen_id,
            'day' => $request->day,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'place' => $request->place,
            'semester' => $request->semester,
            'type' => $request->type,
        ]);
        return redirect()->route('kelas.detail', ['id' => $updt->class_id])->with('success', 'Jadwal Matkul Berhasil Di Update!');
    }

    public function deleteSchedule($id)
    {
        $updt = Schedule::findOrFail($id);
        $updt->delete();
        return redirect()->route('kelas.detail', ['id' => $updt->class_id])->with('success', 'Jadwal Matkul Berhasil Dihapus!');
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
