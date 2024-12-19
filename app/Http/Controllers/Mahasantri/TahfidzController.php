<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\Mahasantri;
use App\Models\QuranMemorizationLog;
use Yajra\DataTables\DataTables;

class TahfidzController extends Controller
{
    public function index()
    {
        $mahasantri = Mahasantri::firstWhere('user_id', auth()->id());
        return view('mahasantri-section.tahfidz.index', compact('mahasantri'));
    }

    public function data()
    {
        $data = QuranMemorizationLog::query()
            ->where('mahasantri_id', auth()->id())
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
