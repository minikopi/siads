<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function VerifPayment(Request $request)
    {
        Config::$serverKey = config('midtrans.midtrans.serverKey');
        Config::$isProduction = config('midtrans.midtrans.isProduction');
        $notif = new Notification();
        // return $notif;

        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;
        $code = $notif->status_code;

        // Log::info($request->all());
        // error_log("Order ID $notif->order_id: "."transaction status = $transaction, fraud staus = $fraud");
        $cekNot = Invoice::where('status', 1)->where('invoice_code', $request->order_id)->first();
        if ($transaction == 'settlement') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                Log::info('pandding');
            } else if ($fraud == 'accept' && !empty($cekNot)) {
                // TODO Set payment status in merchant's database to 'success'
                Log::info('success');
                $model = Invoice::where('invoice_code', $request->order_id)->first();
                $model->status = 2;
                $model->save();
            }
        } else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                Log::info('gagal');
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                Log::info('gagal');
            }
        } else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            Log::info('gagal');
        }
    }
}
