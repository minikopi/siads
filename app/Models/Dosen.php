<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'nomor_induk', 'jabatan', 'tipe'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function matkul()
    {
        return $this->hasMany(MatkulDosen::class, 'dosen_id');
    }

    public function classes(): HasMany
    {
        return $this->HasMany(Classes::class, 'dosen_id', 'id');
    }
}
