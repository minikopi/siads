<?php

namespace App\Helpers;

use App\Models\Payload;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class Midtrans
{
    public static function GetSpapToken($data, $items)
    {
        Config::$serverKey = config('midtrans.midtrans.serverKey');
        Config::$isProduction = config('midtrans.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $transaction_details = array(
            'order_id'      => $data->invoice_code,
            'gross_amount'  => $data->total,
        );


        $customer_details = array(
            'first_name'    => Auth::user()->name, //optional
            'phone'         => Auth::user()->mahasantri->handphone, //mandatory
            'email'         => Auth::user()->mahasantri->email
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'           => $items,
            'customer_details'   => $customer_details
        );

        Payload::create([
            'user_id' => auth()->id(),
            'payload_type' => 'request',
            'payload' => json_encode($transaction_data)
        ]);
        $snapToken = Snap::getSnapToken($transaction_data);
        return $snapToken;
    }
    public static function GetPaymentUrl($data, $items)
    {
        Config::$serverKey = config('midtrans.midtrans.serverKey');
        Config::$isProduction = config('midtrans.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $transaction_details = array(
            'order_id'      => $data->invoice_code,
            'gross_amount'  => $data->total,
        );

        $customer_details = array(
            'first_name'    => Auth::user()->name, //optional
            'phone'         => Auth::user()->mahasantri->handphone, //mandatory
            'email'         => Auth::user()->mahasantri->email
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'           => $items,
            'customer_details'   => $customer_details
        );

        Payload::create([
            'user_id' => auth()->id(),
            'payload_type' => 'request',
            'payload' => json_encode($transaction_data)
        ]);
        $paymentUrl = Snap::createTransaction($transaction_data)->redirect_url;
        return $paymentUrl;
    }
}
