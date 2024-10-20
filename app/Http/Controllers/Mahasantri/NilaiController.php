<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');

        return view('score.mahasiswaView.absent', compact('data'));
    }

    public function data(Request $request)
    {
        $data = Schedule::with("score", "mata_kuliah", "dosen.user", 'class')
            ->where("class_id", Auth::user()->mahasantri->kelas_id)
            ->when($request->smester, function ($q) use ($request) {
                return $q->whereHas("mata_kuliah", function ($b) use ($request) {
                    $b->where("smester", $request->smester);
                });
            })
            ->orderBy('created_at', 'desc');

        return DataTables::of($data)
            ->editColumn('score', function ($data) {
                if (count($data->score) > 1) {
                    return $data->score[0]->akademik;
                }
                return "-";
            })
            ->editColumn('huruf', function ($data) {
                if (count($data->score) > 1) {
                    $nilai = $data->score[0]->akademik;
                    if ($nilai > 80) {
                        return "A";
                    } elseif ($nilai > 70) {
                        return "B";
                    } elseif ($nilai > 60) {
                        return "C";
                    } elseif ($nilai > 50) {
                        return "D";
                    } else {
                        return "E";
                    }
                }
                return "-";
            })
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
