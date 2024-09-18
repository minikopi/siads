<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payload;
use App\Models\Payment;
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
        $model = Invoice::with('details')->where('invoice_code', $order_id)->first();

        if (!$model) {
            Log::warning("webhook tak menemukan invoice-nya: " . $order_id);
            return true;
        }

        if ($model) {
            $model->transaction_status = $transaction;
            $model->fraud_status = $fraud;
            $model->payment_type = $type;
        }

        Payload::create([
            'user_id' => $model->mahasantri->user->id,
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

                    if ($model) {
                        $model->status = Invoice::Void;
                        $merchant = $this->parsePayment($notif);
                        $model->merchant_name = $merchant['name'];
                        $model->merchant_number = $merchant['number'];
                        $model->save();
                    }
                } else {
                    // set payment status in merchant's database to 'Success'
                    Log::info("Transaction order_id: " . $order_id . " successfully captured using " . $type);

                    if ($model) {
                        $model->status = Invoice::Paid;
                        $merchant = $this->parsePayment($notif);
                        $model->merchant_amount = $merchant['amount'];
                        $model->merchant_name = $merchant['name'];
                        $model->merchant_number = $merchant['number'];
                        $model->save();

                        // update tabel payments
                        $mahasantri_id = $model->mahasantri_id;
                        foreach ($model->details as $detail) {
                            $payment = Payment::where([
                                'mahasantri_id' => $mahasantri_id,
                                'payment_type_id' => $detail->payment_type_id
                            ])->first();
                            // $payment->increment('paid', $detail->nominal);
                            $payment->paid = $payment->paid + $detail->nominal;
                            $payment->updated_by = 'Midtrans Webhook';
                            $payment->save();
                        }
                    }
                }
            }
        } else if ($transaction == 'settlement') {
            // set payment status in merchant's database to 'Settlement'
            Log::info("Transaction order_id: " . $order_id . " successfully transfered using " . $type);

            if ($model) {
                $model->status = Invoice::Paid;
                $merchant = $this->parsePayment($notif);
                $model->merchant_amount = $merchant['amount'];
                $model->save();

                // update tabel payments
                $mahasantri_id = $model->mahasantri_id;
                foreach ($model->details as $detail) {
                    $payment = Payment::where([
                        'mahasantri_id' => $mahasantri_id,
                        'payment_type_id' => $detail->payment_type_id
                    ])->first();
                    // $payment->increment('paid', $detail->nominal);
                    $payment->paid = $payment->paid + $detail->nominal;
                    $payment->updated_by = 'Midtrans Webhook';
                    $payment->save();
                }
            }
        } else if ($transaction == 'pending') {
            // set payment status in merchant's database to 'Pending'
            Log::info("Waiting customer to finish transaction order_id: " . $order_id . " using " . $type);

            if ($model) {
                $model->status = Invoice::Pending;
                $merchant = $this->parsePayment($notif);
                $model->merchant_name = $merchant['name'];
                $model->merchant_number = $merchant['number'];
                $model->save();
            }
        } else if ($transaction == 'deny') {
            // set payment status in merchant's database to 'Denied'
            Log::info("Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.");

            if ($model) {
                $model->status = Invoice::Void;
                $model->save();
            }
        } else if ($transaction == 'expire') {
            // set payment status in merchant's database to 'expire'
            Log::info("Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.");

            if ($model) {
                $model->status = Invoice::Void;
                $merchant = $this->parsePayment($notif);
                $model->merchant_name = $merchant['name'];
                $model->merchant_number = $merchant['number'];
                $model->save();
            }
        } else if ($transaction == 'cancel') {
            // set payment status in merchant's database to 'Denied'
            Log::info("Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.");

            if ($model) {
                $model->status = Invoice::Void;
                $merchant = $this->parsePayment($notif);
                $model->merchant_name = $merchant['name'];
                $model->merchant_number = $merchant['number'];
                $model->save();
            }
        }
    }

    public function parsePayment($response)
    {
        $res = [];
        $res['name'] = $response->payment_type;;
        $res['number'] = null;
        $res['amount'] = $response->gross_amount * 0.017;

        // Credit Card
        if ($response->payment_type == 'credit_card') {
            $res['name'] = $response->bank;
            $res['number'] = $response->masked_card;
            $fixed_fee = 2000;
            $res['amount'] = ($response->gross_amount * 0.029) + $fixed_fee; // 2,9% + 2ribu
        }

        // Bank Transfer
        if ($response->payment_type == 'bank_transfer') {
            // BCA, BNI, BRI, CIMB
            if (isset($response->va_numbers)) {
                $res['name'] = $response->va_numbers[0]->bank;
                $res['number'] = $response->va_numbers[0]->va_number;
            } elseif (isset($response->permata_va_number)) { // Permata
                $res['name'] = 'permata';
                $res['number'] = $response->permata_va_number;
            }
            $res['amount'] = 4000;
        }

        // QRIS/GoPay/GoPay Later
        if ($response->payment_type == 'qris') {
            $res['name'] = $response->acquirer;

            if ($response->acquirer == 'airpay shopee') {
                $res['amount'] = $response->gross_amount * 0.02; // 2%
            }

            if ($response->acquirer == 'gopay') {
                $res['amount'] = $response->gross_amount * 0.02; // 2%
            }
        }

        // Indomaret/Alfamart
        if ($response->payment_type == 'cstore') {
            $res['name'] = $response->store;
            $res['number'] = $response->payment_code;

            $res['amount'] = 5000;
        }

        // // Akulaku
        // if ($response->payment_type == 'akulaku') {
        //     $res['name'] = $response->payment_type;
        //     $res['number'] = $response->redirect_url;
        //     $res['amount'] = $response->gross_amount * 0.017; // 1,7%
        // }

        return $res;
    }
}
