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
}
