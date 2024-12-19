<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamEligibility extends Model
{
    protected $fillable = [
        'mahasantri_id',
        'semester',
        'eligible',
        'reason',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'eligible' => 'boolean',
    ];
}
