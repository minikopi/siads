<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasantri extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'nim',
        'nama_depan',
        'nama_belakang',
        'email',
        'handphone',
        'nik',
        'alamat',
        'kode_pos',
        'tanggal_lahir',
        'suku',
        'saudara',
        'whatsapp',
        'foto',
        'nama_ayah',
        'tempat_ayah',
        'lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'tempat_ibu',
        'lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nama_wali',
        'alamat_wali',
        'handphone_wali',
        'whatsapp_wali',
        'asal_sekolah',
        'alamat_sekolah',
        'nomor_ijazah',
        'tanggal_ijazah',
        'asal_pesantren',
        'alamat_pesantren',
        'hobi',
        'golongan_darah',
        'berat_badan',
        'tinggi_badan',
        'penyakit',
        'jenis_kelamin',
        'status',
        'kelas_id'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'kelas_id');
    }
}
