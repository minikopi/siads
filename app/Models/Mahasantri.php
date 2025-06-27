<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Mahasantri extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    // protected $fillable = [
    //     'user_id',
    //     'nim',
    //     'wakaf',
    //     'academic_year_id',
    //     'nama_depan',
    //     'nama_belakang',
    //     'email',
    //     'handphone',
    //     'nik',
    //     'anak_ke',
    //     'kondisi_kemampuan',
    //     'alamat',
    //     'kode_pos',
    //     'tanggal_lahir',
    //     'suku',
    //     'saudara',
    //     'whatsapp',
    //     'foto',
    //     'nama_ayah',
    //     'tempat_ayah',
    //     'lahir_ayah',
    //     'pendidikan_ayah',
    //     'pekerjaan_ayah',
    //     'penghasilan_ayah',
    //     'nama_ibu',
    //     'tempat_ibu',
    //     'lahir_ibu',
    //     'pendidikan_ibu',
    //     'pekerjaan_ibu',
    //     'penghasilan_ibu',
    //     'nama_wali',
    //     'alamat_wali',
    //     'handphone_wali',
    //     'whatsapp_wali',
    //     'asal_sekolah',
    //     'alamat_sekolah',
    //     'nomor_ijazah',
    //     'tanggal_ijazah',
    //     'asal_pesantren',
    //     'alamat_pesantren',
    //     'hobi',
    //     'golongan_darah',
    //     'berat_badan',
    //     'tinggi_badan',
    //     'penyakit',
    //     'jenis_kelamin',
    //     'status',
    //     'kelas_id',
    //     'created_by',
    //     'updated_by'
    // ];

    protected $attributes = [
        'status' => 'aktif'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('Mahasantri');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'kelas_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function academic_year(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
