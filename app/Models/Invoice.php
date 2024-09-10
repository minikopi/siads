<?php

namespace App\Models;

use App\Helpers\Generator as HelpersGenerator;
use Generator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function generateTransactionNumberGroup()
    {

        $lastInvoiceGroup = \App\Models\Invoice::where('mahasantri_id', Auth::user()->mahasantri->id)->whereMonth('created_at', date('n'))->whereYear('created_at', date('Y'))->latest()->first();
        $roman = HelpersGenerator::numberToRoman(date('n'));
        $randomString = substr(str_shuffle('ABCDEFGHJKMNPQRSTUVWXYZ234567'), 0, 5);
        $name = str(Auth::user()->mahasantri->nama_depan)->slug();
        $nunmberGroup = 'INV/' . $randomString . '/' . $name . '/' . $roman . '/' . date('y');
        $numberNow = '0001';
        if (isset($lastInvoiceGroup)) {
            $men = explode('-', $lastInvoiceGroup->invoice_code);
            $numberNow = sprintf("%04s", $men[1] + 1);
        }
        return $nunmberGroup . '-' . $numberNow;
    }
}
