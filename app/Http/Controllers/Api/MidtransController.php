<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payload;
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

        try {
            $notif = new Notification();
            $notif = $notif->getResponse();
            // Log::info($notif);
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
            Payload::create([
                'payload_type' => 'response',
                'payload' => $e->getMessage()
            ]);

            return;
        }

        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;
        $code = $notif->status_code;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;

        // simpan payload
        Payload::create([
            'payload_type' => 'response',
            'payload' => json_encode($notif)
        ]);

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    Log::info("Transaction order_id: " . $order_id . " is challenged by FDS");
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    Log::info("Transaction order_id: " . $order_id . " successfully captured using " . $type);
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            Log::info("Transaction order_id: " . $order_id . " successfully transfered using " . $type);

            $model = Invoice::where('invoice_code', $order_id)->first();
            if ($model) {
                $model->status = 2;
                $model->save();
            }
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            Log::info("Waiting customer to finish transaction order_id: " . $order_id . " using " . $type);
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            Log::info("Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.");
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            Log::info("Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.");
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            Log::info("Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.");
        }
    }
}
