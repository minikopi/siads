<?php

namespace App\Http\Controllers;

use App\Http\Requests\Master\MahasantriImportRequest;
use App\Http\Requests\Master\MahasantriStore;
use App\Http\Requests\Master\MahasantriUpdate;
use App\Imports\MahasantriImport;
use App\Models\AcademicYear;
use App\Models\Mahasantri;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MahasantriController extends Controller
{
    public function index()
    {
        $academic_years = AcademicYear::select('full_year')->visible()->urut()->get();
        $lakilakiCount = Mahasantri::where('jenis_kelamin', 'laki-laki')->count();
        $perempuanCount = Mahasantri::where('jenis_kelamin', 'perempuan')->count();
        return view('mahasantri.index', compact('lakilakiCount', 'perempuanCount', 'academic_years'));
    }

    public function dataGet(Request $request)
    {
        $data = Mahasantri::with('class')->select(['nama_depan', 'nama_belakang', 'nama_lengkap', 'nim', 'email', 'id', 'kelas_id'])->latest();

        if ($request->has('angkatan')) {
            $data->where('academic_year_id', $request->angkatan);
        }

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->addColumn('angkatan', function ($data) {
                return $data?->class?->nama ?? '-';
            })
            ->addColumn('nama', function ($data) {
                return $data->nama_depan . ' ' . $data->nama_belakang;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        $academic_years = AcademicYear::visible()->urut()->get();
        return view('mahasantri.create', compact('academic_years'));
    }

    public function store(MahasantriStore $request)
    {
        DB::beginTransaction();
        try {
            // check keunikan email
            $userCheck = User::firstWhere('email', $request->email);
            $mahasantriCheck = Mahasantri::firstWhere('email', $request->email);
            if ($userCheck || $mahasantriCheck) throw new \Exception('Email sudah terdaftar');

            $user = User::create([
                'name'      => $request->nama_depan . " " . $request->nama_belakang,
                'email'     => $request->email,
                'password'  => password_hash('password', PASSWORD_DEFAULT),
                'role'      => 'Mahasantri',
            ]);

            $data = array_merge($request->except(['foto']), [
                'whatsapp_wali' => $request->handphone_wali,
                'foto' => $request->file('foto')->store('mahasantri/foto')
            ]);

            $user->mahasantri()->create($data);

            $user->addRole(Role::Mahasantri);
        } catch (\Exception $e) {
            DB::rollback();
            Log::warning($e->getMessage(), [
                'action' => 'store mahasantri',
                'data' => $request->validated(),
                'user' => $request->user(),
            ]);
            return back()->withInput()->with('error', 'Data Mahasantri Gagal Dibuat!');
        }
        DB::commit();

        return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri berhasil ditambahkan.');
    }

    public function import()
    {
        $title = 'Import Mahasantri';
        $academic_years = AcademicYear::visible()->urut()->get();
        return view('mahasantri.import', compact('academic_years', 'title'));
    }

    public function importUpload(MahasantriImportRequest $request)
    {
        $academic_year = AcademicYear::firstOrCreate([
            'start_year' => $request->tahun_ajaran,
            'end_year' => $request->tahun_ajaran + 1,
        ]);

        try {
            Excel::queueImport(new MahasantriImport($academic_year), $request->file('excel'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                Log::warning($e->getMessage(), [
                    'action' => 'import mahasantri',
                    'row' => $failure->row(),               // row that went wrong
                    'attribute' => $failure->attribute(),   // either heading key (if using heading row concern) or column index
                    'errors' => $failure->errors(),         // Actual error messages from Laravel validator
                    'values' => $failure->values(),         // The values of the row that has failed.
                    'user' => $request->user(),
                ]);
            }

            return back()->withInput()->with('error', 'Data Mahasantri Gagal Di-import!');
        }

        return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri berhasil di-import.');
    }

    public function edit($id)
    {
        $data = Mahasantri::findOrFail($id);
        $academic_years = AcademicYear::visible()->urut()->get();
        return view('mahasantri.edit', compact('data', 'academic_years'));
    }

    public function update(MahasantriUpdate $request, $id)
    {
        try {
            DB::beginTransaction();
            $mahasantri = Mahasantri::findOrFail($id);

            // check keunikan email
            $userCheck = User::where([
                ['email', '=', $request->email],
                ['id', '<>', $mahasantri->user_id]
            ])->first();
            $mahasantriCheck = Mahasantri::where([
                ['email', '=', $request->email],
                ['id', '<>', $id]
            ])->first();
            if ($userCheck || $mahasantriCheck) throw new \Exception('Email sudah terdaftar');

            if ($request->hasFile('foto')) {
                if (! is_null($mahasantri->foto)) {
                    if (Storage::exists($mahasantri->foto)) {
                        Storage::delete($mahasantri->foto);
                    }
                }

                $mahasantri->update([
                    'foto' => $request->file('foto')->store('mahasantri/foto')
                ]);
            }

            $mahasantri->update($request->except(['foto']));

            $mahasantri->user()->update([
                'name' => $mahasantri->nama_lengkap,
                'email' => $mahasantri->email,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::warning($e->getMessage(), [
                'action' => 'update mahasantri',
                'data' => $request->validated(),
                'user' => $request->user(),
            ]);
            return back()->withInput()->with('error', $e->getMessage());
        }
        DB::commit();
        return redirect()->route('mahasantri.index')->with('success', 'Data Mahasantri berhasil diubah.');
    }

    public function delete($id)
    {
        return response()->json(
            ['msg' => 'Maaf, Anda tidak dapat melakukan ini. Hubungi web administrator.'],
            400
        );
    }
}
