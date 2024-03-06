<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    public $fillable = ['mahasiswa_id', 'prestasi', 'file', 'status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasantri::class, 'mahasiswa_id');
    }
}
