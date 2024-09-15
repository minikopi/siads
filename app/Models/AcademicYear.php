<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory;

    protected $guarded = ['full_year'];

    protected $casts = [
        'active' => 'boolean',
        'registration' => 'boolean',
        'visible' => 'boolean',
    ];

    public function scopeVisible(Builder $query): void
    {
        $query->where('visible', true);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    public function scopeRegistration(Builder $query): void
    {
        $query->where('registration', true);
    }

    public function scopeUrut(Builder $query): void
    {
        $query->orderByDesc('start_year');
    }

    public function payment_types(): HasMany
    {
        return $this->hasMany(PaymentType::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
