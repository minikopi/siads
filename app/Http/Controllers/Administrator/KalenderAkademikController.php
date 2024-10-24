<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\KalenderAkademikStore;
use App\Http\Requests\Administrator\KalenderAkademikUpdate;
use App\Models\AcademicYear;
use App\Models\Akademik;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        return view('admin-section.kalender-akademik.index');
    }

    public function data()
    {
        $data = Akademik::latest();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('admin-section.kalender-akademik.button', compact('data'));
            })
            ->editColumn('tanggal_mulai', function ($data) {
                return Carbon::parse($data->tanggal_mulai)->translatedFormat('d F Y');
            })
            ->editColumn('tanggal_akhir', function ($data) {
                return Carbon::parse($data->tanggal_akhir)->translatedFormat('d F Y');
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $academic_years = AcademicYear::visible()->urut()->get();
        return view('admin-section.kalender-akademik.create', compact('academic_years'));
    }

    public function store(KalenderAkademikStore $request)
    {
        try {
            DB::beginTransaction();

            Akademik::create($request->validated());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', $th->getMessage());
        }

        return redirect()->route('administrator.akademik.index')->with('success', 'Data Kalender Akademik Berhasil Dibuat!');
    }

    public function edit(Akademik $akademik)
    {
        $academic_years = AcademicYear::visible()->urut()->get();
        return view('admin-section.kalender-akademik.edit', compact('academic_years', 'akademik'));
    }

    public function update(KalenderAkademikUpdate $request, Akademik $akademik)
    {
        try {
            DB::beginTransaction();

            $akademik->update($request->validated());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', $th->getMessage());
        }

        return redirect()->route('administrator.akademik.index')->with('success', 'Data Kalender Akademik Berhasil Diubah!');
    }

    public function destroy(Akademik $akademik)
    {
        try {
            DB::beginTransaction();

            $akademik->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                ['msg' => $th->getMessage()],
                $th->getCode()
            );
        }

        return response()->json(
            [
                'msg' => 'Berhasil menghapus data',
                'redirect' => route('administrator.akademik.index')
            ]
        );
    }
}
