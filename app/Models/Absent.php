<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    public $fillable = ['schedule_id', 'mahasiswa_id', 'tanggal', 'status'];


    public static function getSummeryByData($id)
    {
        return self::where('schedule_id', $id)
            ->select('tanggal')
            ->selectRaw('COUNT(CASE WHEN status = "HADIR" THEN 1 END) AS jumlah_hadir')
            ->selectRaw('COUNT(CASE WHEN status = "SAKIT" THEN 1 END) AS jumlah_sakit')
            ->selectRaw('COUNT(CASE WHEN status = "IZIN" THEN 1 END) AS jumlah_izin')
            ->selectRaw('COUNT(CASE WHEN status = "GHOIB" THEN 1 END) AS jumlah_ghoib')
            ->selectRaw('COUNT(CASE WHEN status = "TERLAMBAT" THEN 1 END) AS jumlah_terlambat')
            ->selectRaw('((COUNT(CASE WHEN status = "HADIR" THEN 1 END) - COUNT(CASE WHEN status != "HADIR" THEN 1 END)) / COUNT(*)) * 100 as persen')
            ->groupBy('tanggal')
            ->orderBy('tanggal', "DESC")
            ->get();
    }
}
