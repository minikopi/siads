<?php

namespace App\Http\Controllers\Tahfidz;

use App\Http\Controllers\Controller;
use App\Models\QuranMemorizationLog;
use Yajra\DataTables\DataTables;

class DataController extends Controller
{
    public function index()
    {
        return view('tahfidz-section.data.index');
    }

    public function data()
    {
        $data = QuranMemorizationLog::query()
            ->whereNotNull('page_number')
            ->latest();

        $data = DataTables::of($data)
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at->translatedFormat('d F Y - H:i');
            })
            ->make(true);
        return $data;
    }
}
