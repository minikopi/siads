<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class QuranMemorization extends Model
{
    use LogsActivity;

    const SAH = 'sah';
    const TIDAK_SAH = 'tidak sah';

    protected $fillable = [
        'mahasantri_id',
        'juz_number',
        'page_number',
        'dosen_id',
        'status',
        'created_by',
        'updated_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('QuranMemorization');
    }

    public function mahasantri(): BelongsTo
    {
        return $this->belongsTo(Mahasantri::class, 'mahasantri_id', 'id');
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
