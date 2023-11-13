<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;

    public $fillable = ['nama', 'tanggal_mulai', 'tanggal_akhir', 'semester', 'tahun_ajaran', 'keterangan'];
}
