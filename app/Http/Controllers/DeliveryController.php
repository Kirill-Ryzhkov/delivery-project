<?php

namespace App\Http\Controllers;

use App\Services\DestinationService;
use App\Services\DeliveryService;
use App\Services\PriceService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * @OA\GET(
     *     path="/api/fastDelivery",
     *     description="Get price, time for fast delivery",
     *     tags={"Company"},
     *     @OA\Response(
     *         response="200",
     *         description=""
     *     ),
     *    @OA\Parameter(
     *         description="Source city",
     *         name="sourceCity",
     *         required=true,
     *         in="query"
     *     ),
     *     @OA\Parameter(
     *         description="Destination city",
     *         name="destinationCity",
     *         required=true,
     *         in="query"
     *     ),
     *     @OA\Parameter(
     *         description="Weight of pakage",
     *         name="weight",
     *         required=true,
     *         in="query"
     *     ),
     * )
     *
     */
    public function fastDelivery(Request $request)
    {
        $request->validate([
            "sourceCity" => "required",
            "destinationCity" => "required",
            "weight" => "required"
        ]);
        $destination = DeliveryService::getDestinationKillometers($request->sourceCity, $request->destinationCity);
        $price = PriceService::getFastDeliveryPrice($destination, $request->weight);
        $time = DeliveryService::getFastDeliveryTime($destination);
        $response = [
            "price" => $price,
            "period" => $time,
            "error" => ""
        ];
        return response()->json($response);
    }

    /**
     * @OA\GET(
     *     path="/api/slowDelivery",
     *     description="Get coefficient, time for slow delivery",
     *     tags={"Company"},
     *     @OA\Response(
     *         response="200",
     *         description=""
     *     ),
     *    @OA\Parameter(
     *         description="Source city",
     *         name="sourceCity",
     *         required=true,
     *         in="query"
     *     ),
     *     @OA\Parameter(
     *         description="Destination city",
     *         name="destinationCity",
     *         required=true,
     *         in="query"
     *     ),
     *     @OA\Parameter(
     *         description="Weight of pakage",
     *         name="weight",
     *         required=true,
     *         in="query"
     *     ),
     * )
     *
     */
    public function slowDelivery(Request $request)
    {
        $request->validate([
            "sourceCity" => "required",
            "destinationCity" => "required",
            "weight" => "required"
        ]);
        $destination = DeliveryService::getDestinationKillometers($request->sourceCity, $request->destinationCity);
        $coef = PriceService::getSlowDeliveryCoefficient($destination, $request->weight);
        $time = DeliveryService::getSlowDeliveryTime($destination);
        $response = [
            "coefficient" => $coef,
            "period" => $time,
            "error" => ""
        ];
        return response()->json($response);
    }
}
