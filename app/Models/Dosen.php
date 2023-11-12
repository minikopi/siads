<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'nomor_induk', 'jabatan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
