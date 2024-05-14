<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $fillable = ['class_id', 'mata_kuliah_id', "dosen_id", "day", "start_date", "end_date", "place", 'type'];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function mata_kuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    public function absent()
    {
        return $this->hasMany(Absent::class, 'id');
    }

    public function score()
    {
        return $this->hasMany(Score::class, 'schedule_id');
    }
}
