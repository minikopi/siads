<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasantri;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['mahasantri'] = Mahasantri::count();
        $data['dosen']      = Dosen::count();

        return view('dashboard', compact('data'));
    }
}
