<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classes extends Model
{
    protected $table = 'classes';
    use HasFactory;

    public $fillable = ['nama', 'tahun_ajaran', "current_semaster", "gender", "musyrif_id"];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
}
