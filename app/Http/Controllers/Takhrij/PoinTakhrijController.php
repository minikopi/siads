<?php

namespace App\Http\Controllers\Takhrij;

use App\Http\Controllers\Controller;
use App\Http\Requests\Takhrij\TrialPointStore;
use App\Models\TrialPoint;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PoinTakhrijController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('takhrij.admin.poin.index');
    }

    public function dataGet()
    {
        $data = TrialPoint::orderBy('sequence')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('takhrij.admin.poin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrialPointStore $request)
    {
        TrialPoint::create($request->validated());

        return redirect()->route('takhrij.points.index')->with('success', 'Data Poin Syarat Sidang Berhasil Dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrialPoint $trialPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrialPoint $trialPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrialPoint $trialPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrialPoint $trialPoint)
    {
        //
    }
}
