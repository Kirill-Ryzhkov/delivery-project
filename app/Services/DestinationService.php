<?php

namespace App\Services;

use Dadata\DadataClient;

class DestinationService
{
    protected DadataClient $dadata;

    public function __construct()
    {
        $this->dadata = new DadataClient("a0e069f58d2cd08599275fff590f12d9f3ee8515", "d9e21a2815fb8e059ae0bc8f645c8ac0d102c515");
    }

    public function getDestination($citySource, $cityDest)
    {
        $citySourceCoordinates = $this->dadata->clean("address", $citySource);
        $cityDestCoordinates = $this->dadata->clean("address", $cityDest);
        $lat1 = $this->degreesToRadians($citySourceCoordinates['geo_lat']);
        $lon1 = $this->degreesToRadians($citySourceCoordinates['geo_lon']);
        $lat2 = $this->degreesToRadians($cityDestCoordinates['geo_lat']);
        $lon2 = $this->degreesToRadians($cityDestCoordinates['geo_lon']);
        return $this->getDestinationKillometers($lat1, $lon1, $lat2, $lon2);
    }

    public function getDestinationKillometers($lat1, $lon1, $lat2, $lon2)
    {
        $radius = 6371;
        return round($radius * acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lon1 - $lon2)));
    }

    public function degreesToRadians($degrees)
    {
        return $degrees * M_PI / 180;
    }
}
