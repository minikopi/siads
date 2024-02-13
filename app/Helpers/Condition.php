<?php

namespace App\Helpers;

class Condition
{
    public static function CheckStatuPayment($currentSmester, $smester)
    {
        if ($currentSmester == $smester) {
            return 'Berjalan';
        }
        if ($currentSmester > $smester) {
            return 'Selesai';
        }

        return 'Belum Berjalan';
    }
}
