<?php

namespace App\Http\Controllers\Mahasantri;

use App\Helpers\Midtrans;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Mahasantri;
use App\Models\Payload;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;

class CancelPembayaranController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Invoice $invoice)
    {
        $user = Auth::user();
        $data = [];

        Log::warning('Cancel pembayaran #' . $invoice->invoice_code, [
            'user' => $request->user(),
        ]);

        if (! $user->hasRole(Role::Mahasantri)) {
            return to_route('mahasantri.pembayaran.index')->with('error', 'Hanya bisa diakses oleh Mahasantri.');
        }


        if ($invoice->mahasantri()->isNot($request->user()->mahasantri)) {
            Log::warning('Percobaan membatalkan pembayaran milik orang lain', [
                'user' => $request->user(),
                'action' => 'Cancel pembayaran #' . $invoice->invoice_code
            ]);
            return to_route('mahasantri.pembayaran.index')->with('error', 'Anda tidak memiliki akses untuk melakukan hal tersebut.');
        }

        Payload::create([
            'user_id' => $request->user()->id,
            'payload_type' => 'request',
            'payload' => 'Cancel #' . $invoice->invoice_code
        ]);

        $invoice->notes = 'Dibatalkan oleh ' . $invoice->mahasantri->nama_lengkap;
        $invoice->status = Invoice::Void;
        $invoice->save();

        return to_route('mahasantri.pembayaran.index')->with('success', 'Transaksi Anda berhasil dibatalkan.');
    }
}
