<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index()
    {
        return view('mata-kuliah.index');
    }

    public function getData()
    {
        $data = MataKuliah::get();

        return DataTables::of($data)->make(true);
    }
}
