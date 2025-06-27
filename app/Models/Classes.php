<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    protected $table = 'classes';
    use HasFactory;
    use SoftDeletes;

    public $fillable = ['nama', 'tahun_ajaran', "current_semaster", "gender", "dosen_id", 'musyrif_id', 'academic_year_id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }
}
