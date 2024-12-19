<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\AcademicYearStore;
use App\Http\Requests\Master\AcademicYearUpdate;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('academic-year.index');
    }

    public function dataGet()
    {
        $data = AcademicYear::select(['id', 'full_year', 'visible', 'active', 'registration'])->urut();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('visible', function ($data) {
                if ($data->visible) {
                    $res = '<span class="text-success font-weight-bold">Aktif</span>';
                } else {
                    $res = '<span class="text-danger">Tidak Aktif</span>';
                }
                return $res;
            })
            ->editColumn('active', function ($data) {
                if ($data->active) {
                    $res = '<span class="text-success font-weight-bold">Ya</span>';
                } else {
                    // $res = '<span class="text-danger">Tidak</span>';
                    $res = '';
                }
                return $res;
            })
            ->editColumn('registration', function ($data) {
                if ($data->registration) {
                    $res = '<span class="text-success font-weight-bold">Ya</span>';
                } else {
                    // $res = '<span class="text-danger">Tidak</span>';
                    $res = '';
                }
                return $res;
            })
            ->rawColumns(['action', 'visible', 'active', 'registration'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic-year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicYearStore $request)
    {
        try {
            DB::beginTransaction();
            $check = AcademicYear::firstWhere('start_year', $request->start_year);
            if ($check) throw new \Exception('Data sudah ada.');

            $selisih = $request->end_year - $request->start_year;
            if ($selisih > 1) throw new \Exception('Data tidak valid.');

            if ($request->has('active')) {
                $hasActive =  AcademicYear::firstWhere('active', true);
                if ($hasActive) $hasActive->update(['active' => false]);
            }

            if ($request->has('registration')) {
                $hasRegistration =  AcademicYear::firstWhere('registration', true);
                if ($hasRegistration) $hasRegistration->update(['registration' => false]);
            }

            AcademicYear::create($request->validated());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::warning($th->getMessage(), [
                'action' => 'store academic year',
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
        return to_route('academic-year.index')->with('success', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        return view('academic-year.edit', [
            'data' => $academicYear
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicYearUpdate $request, AcademicYear $academicYear)
    {
        try {
            $check = AcademicYear::where([
                ['start_year', '=', $request->start_year],
                ['id', '<>', $academicYear->getKey()],
            ])->first();
            if ($check) throw new \Exception('Data sudah ada.');

            $selisih = $request->end_year - $request->start_year;
            if ($selisih > 1) throw new \Exception('Data tidak valid.');

            if ($request->has('active')) {
                $hasActive =  AcademicYear::firstWhere([
                    ['active', '=', true],
                    ['id', '<>', $academicYear->getKey()]
                ]);
                if ($hasActive) $hasActive->update(['active' => false]);
            }

            if ($request->has('registration')) {
                $hasRegistration =  AcademicYear::firstWhere([
                    ['registration', '=', true],
                    ['id', '<>', $academicYear->getKey()]
                ]);
                if ($hasRegistration) $hasRegistration->update(['registration' => false]);
            }

            $academicYear->update($request->validated());
        } catch (\Throwable $th) {
            Log::warning($th->getMessage(), [
                'action' => 'update academic year',
                'user' => $request->user(),
                'data' => $request->validated(),
            ]);

            return back()->withInput()->with('error', $th->getMessage());
        }
        return to_route('academic-year.index')->with('success', 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        return response()->json(
            ['msg' => 'Maaf, Anda tidak dapat melakukan ini. Hubungi web administrator.'],
            400
        );
    }
}
