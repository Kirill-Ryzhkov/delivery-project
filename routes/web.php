<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('api')->group(function (){
    Route::get('fastDelivery', [DeliveryController::class, "fastDelivery"]);
    Route::get('slowDelivery', [DeliveryController::class, "slowDelivery"]);
});

