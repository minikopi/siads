<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edaran extends Model
{
    use HasFactory;

    public $fillable = ['nama', 'no', 'tanggal', 'status', 'file'];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
