<?php

namespace App\Http\Controllers\Mahasantri;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TranskripNilaiController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::select('SELECT
	*
from
	mata_kuliahs mk
left join
(SELECT s.mata_kuliah_id, s2.mahasiswa_id, s2.persentasi_kehadiran, s2.akademik, s2.non_akademik from schedules s
join scores s2 on s.id = s2.schedule_id
where s2.mahasiswa_id = ?
) as s on mk.id = s.mata_kuliah_id
order by smester ASC, nama ASC', [Auth::user()->mahasantri->id]);
        // dd($data);
        return view('mahasantri-section.transkrip-nilai.index', compact('data'));
    }
}
