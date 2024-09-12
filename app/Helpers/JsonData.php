<?php

namespace App\Helpers;

use App\Models\PaymentType;

class JsonData
{
    public static function TypePayment()
    {
        return [
            '1' => PaymentType::TIPE_PEMBAYARAN_AWAL_SEMESTER_LUNAS_TEXT,
            '2' => PaymentType::TIPE_PEMBAYARAN_HARUS_SEBELUM_SEMESTER_BERAKHIR_LUNASCICIL_TEXT,
            '3' => PaymentType::TIPE_PEMBAYARAN_SAMPAI_LULUS_LUNASCICIL_TEXT,
        ];
    }

    public static function MidtransStatus()
    {
        return [
            '1' => 'Menunggu Pembayaran',
            '2' => 'Sudah Dibayarkan',
            '3' => 'Expired',
        ];
    }

    public static function PaymentStatus()
    {
        return [
            'Pending' => 'Belum Lunas',
            'Waiting for Payment' => 'Belum Lunas',
            'Paid' => 'Lunas',
            '3' => 'Kedaluwarsa'
        ];
    }
}
