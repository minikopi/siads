<?php

namespace App\Service;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Dosen;
use App\Models\Mahasantri;
use Illuminate\Support\Str;

class MahasantriService
{
    public static function createNim(AcademicYear $academic_year): string
    {
        $tahunMasuk = substr($academic_year->start_year, 2, 2);
        $angkatan = $tahunMasuk + 2;

        $jumlah = Mahasantri::where('academic_year_id', $academic_year->getKey())->count() + 1;

        return sprintf("%u.%u.%s", $angkatan, $tahunMasuk, Str::padLeft($jumlah, 3, '0'));
    }

    public static function createClass(AcademicYear $academic_year, string $jenis_kelamin): Classes
    {
        $musyrif = Dosen::where('tipe', 'Musyrif')->inRandomOrder()->first();

        $class = Classes::firstOrCreate(
            [
                'academic_year_id' => $academic_year->getKey(),
                'gender' => $jenis_kelamin
            ],
            [
                'tahun_ajaran' => $academic_year->start_year,
                'nama' => sprintf("%u %s", $academic_year->start_year, $jenis_kelamin === 'Laki-laki' ? 'Banin' : 'Banat'),
                'dosen_id' => $musyrif->getKey(),
            ]
        );

        return $class;
    }
}
