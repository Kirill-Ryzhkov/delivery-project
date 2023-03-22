<?php

namespace App\Services;

use Illuminate\Http\Request;

class DeliveryService
{
    public static function getDestinationKillometers($sourceCity, $destinationCity)
    {
        $destination = new DestinationService();
        $killometers = $destination->getDestination($sourceCity, $destinationCity);
        $killometers += $killometers * 0.15;
        return $killometers;
    }

    public static function getFastDeliveryTime($destination)
    {
        $time = ceil(($destination / 80) / 8 + 1);
        return $time;
    }

    public static function getSlowDeliveryTime($destination)
    {
        $time = ceil(($destination / 50) / 8 + 3);
        $date = date("Y-m-d", strtotime("+" . $time . " days"));
        return $date;
    }
}
