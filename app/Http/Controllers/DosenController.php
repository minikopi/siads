<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    public function index()
    {
        return view('dosen.index');
    }

    public function getData()
    {
        $data = Dosen::get();

        $data->transform(function ($item) {
            $item->user_id = 'test';
            $item->nomor_induk = '00001';
            $item->jabatan = 'baru';

            return $item;
        });

        return DataTables::of($data)->make(true);
    }

    public function create()
    {
        return view('dosen.create');
    }
}
