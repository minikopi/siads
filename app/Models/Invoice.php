<?php

namespace App\Models;

use App\Helpers\Generator as HelpersGenerator;
use Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    use HasFactory;

    const Pending = 'Pending';
    const Paid = 'Paid';
    const Void = 'Void';
    protected $guarded = [];

    public function mahasantri(): BelongsTo
    {
        return $this->belongsTo(Mahasantri::class, 'mahasantri_id', 'id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailInvoice::class, 'invoice_id', 'id');
    }

    public static function generateTransactionNumberGroup()
    {

        $lastInvoiceGroup = \App\Models\Invoice::where('mahasantri_id', Auth::user()->mahasantri->id)->whereMonth('created_at', date('n'))->whereYear('created_at', date('Y'))->latest()->first();
        $roman = HelpersGenerator::numberToRoman(date('n'));
        $randomString = substr(str_shuffle('ABCDEFGHJKMNPQRSTUVWXYZ234567'), 0, 5);
        $name = strtoupper(str(Auth::user()->mahasantri->nama_depan)->slug());
        $nunmberGroup = 'INV/' . $name . '/' . $randomString . '/' .  $roman . '/' . date('y');
        $numberNow = '0001';
        if (isset($lastInvoiceGroup)) {
            $men = explode('-', $lastInvoiceGroup->invoice_code);
            $numberNow = sprintf("%04s", $men[1] + 1);
        }
        return $nunmberGroup . '-' . $numberNow;
    }
}
