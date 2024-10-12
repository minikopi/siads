<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payload;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        if (!$user->hasRole(Role::Admin)) {
            return back()->with('error', 'Hanya bisa diakses oleh Mahasantri.');
        }

        Payload::create([
            'user_id' => $request->user()->id,
            'payload_type' => 'request',
            'payload' => 'Cancel #' . $invoice->invoice_code
        ]);

        $alasan_pembatalan = 'Dibatalkan oleh ' . auth()->user()->name;

        if ($request->has('alasan_pembatalan')) {
            $alasan_pembatalan .= ".\r\n" . $request->alasan_pembatalan;
        }

        $invoice->notes = $alasan_pembatalan;
        $invoice->status = Invoice::Void;
        $invoice->save();

        // return to_route('pembayaran.index', $invoice->mahasantri_id)->with('success', 'Transaksi Anda berhasil dibatalkan.');
        return back()->with('success', 'Transaksi Anda berhasil dibatalkan.');
    }
}
