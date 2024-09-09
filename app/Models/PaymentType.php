<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    const TIPE_PEMBAYARAN_AWAL_SEMESTER_LUNAS = 1;
    const TIPE_PEMBAYARAN_AWAL_SEMESTER_LUNAS_TEXT = 'Pembayaran Awal Semester (Lunas)';
    const TIPE_PEMBAYARAN_HARUS_SEBELUM_SEMESTER_BERAKHIR_LUNASCICIL = 2;
    const TIPE_PEMBAYARAN_HARUS_SEBELUM_SEMESTER_BERAKHIR_LUNASCICIL_TEXT = 'Pembayaran Harus Lunas Sebelum Smester Berkahir (Lunas / Cicil)';
    const TIPE_PEMBAYARAN_SAMPAI_LULUS_LUNASCICIL = 3;
    const TIPE_PEMBAYARAN_SAMPAI_LULUS_LUNASCICIL_TEXT = 'Pembayaran Sampai Lulus (Lunas / Cicil)';

    protected $guarded = [];
}
