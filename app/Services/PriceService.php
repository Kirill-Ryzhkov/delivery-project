<?php

namespace App\Services;

class PriceService
{
    public static function getFastDeliveryPrice($destination, $weight)
    {
        $baseFastPrice = 5;
        $price = round($destination * $weight * $baseFastPrice);
        return $price;
    }

    public static function getSlowDeliveryCoefficient($destination, $weight)
    {
        $baseSlowPrice = 150;
        $coef = round(($destination / 100) * $weight);
        return $coef;
    }
}
