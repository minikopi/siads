<?php

namespace App\Helpers;

class JsonData
{
    public static function TypePayment()
    {
        return [
            '1' => 'Pembayaran Awal Smester (Lunas)',
            '2' => 'Pembayaran Harus Lunas Sebelum Smester Berkahir (Lunas / Cicil)',
            '3' => 'Pembayaran Sampai Lulus (Lunas / Cicil)',
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
            '1' => 'Belum Lunas',
            '2' => 'Lunas',
        ];
    }
}
