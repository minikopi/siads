<?php

namespace App\Helpers;

class Formater
{
    public static function RupiahCurrency($nominal)
    {
        $formattedValue = 'Rp. ' . number_format($nominal, 0, ',', '.');
        return $formattedValue;
    }
}
