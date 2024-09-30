<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function formatBDT($amount)
    {
        // Format the amount with commas as thousand separators and two decimal places
        $formattedAmount = number_format(abs($amount), 2, '.', ',');

        // Add the BDT currency symbol and handle negative amounts
        return ($amount < 0 ? '-' : '') . $formattedAmount . '৳ ';
    }
}
