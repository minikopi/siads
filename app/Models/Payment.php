<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'total',
        'discount',
        'paid'
    ];

    protected $casts = [
        'installment' => 'boolean',
        'due_date' => 'date'
    ];

    public function mahasantri(): BelongsTo
    {
        return $this->belongsTo(Mahasantri::class);
    }

    public function academic_year(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function payment_type(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
}
