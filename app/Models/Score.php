<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasantri::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
