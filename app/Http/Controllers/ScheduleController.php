<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // $lakilakiCount = Mahasantri::where('jenis_kelamin', 'laki-laki')->count();
        // $perempuanCount = Mahasantri::where('jenis_kelamin', 'perempuan')->count();
        return view('schedule.index');
    }

    public function detail($id)
    {
        $data['class'] = Classes::findOrFail($id);
        $data['smester'] = MataKuliah::distinct('smester')->pluck('smester');
        return view('schedule.detail', compact('data'));
    }
}
