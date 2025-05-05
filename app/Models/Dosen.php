<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Dosen extends Model
{
    use HasFactory;
    use LogsActivity;

    public $fillable = ['user_id', 'nomor_induk', 'jabatan', 'tipe'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('Dosen');
    }

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
