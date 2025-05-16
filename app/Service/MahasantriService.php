<?php

namespace App\Service;

use App\Models\AcademicYear;
use App\Models\Mahasantri;
use Illuminate\Support\Str;

class MahasantriService
{
    public static function createNim(AcademicYear $academic_year): string
    {
        $tahunMasuk = substr($academic_year->start_year, 2, 2);
        $angkatan = $tahunMasuk + 2;

        $jumlah = Mahasantri::where('academic_year_id', $academic_year->getKey())->count() + 1;

        return sprintf("%u.%u.%u", [$angkatan, $tahunMasuk, Str::padLeft($jumlah, 3, '0')]);
    }
}
