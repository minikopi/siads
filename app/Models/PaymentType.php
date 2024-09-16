<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentType extends Model
{
    use HasFactory;

    const TIPE_PEMBAYARAN_AWAL_SEMESTER_LUNAS = 1;
    const TIPE_PEMBAYARAN_AWAL_SEMESTER_LUNAS_TEXT = 'Pembayaran Awal Semester (Lunas)';
    const TIPE_PEMBAYARAN_HARUS_SEBELUM_SEMESTER_BERAKHIR_CICIL = 2;
    const TIPE_PEMBAYARAN_HARUS_SEBELUM_SEMESTER_BERAKHIR_CICIL_TEXT = 'Pembayaran Harus Lunas Sebelum Semester Berkahir (Lunas / Cicil)';
    const TIPE_PEMBAYARAN_SAMPAI_LULUS_CICIL = 3;
    const TIPE_PEMBAYARAN_SAMPAI_LULUS_CICIL_TEXT = 'Pembayaran Sampai Lulus (Lunas / Cicil)';

    protected $guarded = [];

    protected $casts = [
        'published' => 'boolean',
        'due_date' => 'date'
    ];

    public function academic_year(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
