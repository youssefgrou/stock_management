<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount)
    {
        // Format with Moroccan style (1.234,56 MAD)
        $formatted = number_format($amount, 2, ',', '.');
        return $formatted . ' د.م.';
    }

    public static function formatWithSymbol($amount)
    {
        // Format with Moroccan Dirham symbol
        $formatted = number_format($amount, 2, ',', '.');
        return $formatted . ' درهم';
    }
} 