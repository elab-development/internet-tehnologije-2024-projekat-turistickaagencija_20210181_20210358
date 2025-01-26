<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ArrangementController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReservationController;

use App\Http\Resources\PartnerResources;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#client-routes

Route::get('/client', [ClientController::class,'index']);
Route::get('/client/{id}', [ClientController::class, 'show']);
Route::post('/client/store', [ClientController::class, 'store']);
Route::delete('/client/destroy/{client}', [ClientController::class, 'destroy']);
Route::patch('/client/update/{client}',[ClientController::class,'update']);

#partner-routes

Route::resource('partner',PartnerController::class);
Route::delete('/partner/destroy/{partner}', [PartnerController::class, 'destroy']);
Route::patch('/partner/update/{partner}', [PartnerController::class, 'update']);
Route::post('/partner/store', [PartnerController::class, 'store']);

#destination-routes
Route::get('/destination', [DestinationController::class,'index']);
Route::get('/destination/{id}', [DestinationController::class, 'show']);
Route::patch('/destination/update/{destination}', [DestinationController::class, 'update']);
Route::delete('/destination/destroy/{destination}', [DestinationController::class, 'destroy']);
Route::post('/destination/store', [DestinationController::class, 'store']);

#arrangements-routes

Route::get('/arrangement', [ArrangementController::class,'index']);
Route::get('/arrangement/{id}', [ArrangementController::class, 'show']);
Route::patch('/arrangement/update/{arrangement}', [ArrangementController::class, 'update']);
Route::delete('/arrangement/destroy/{arrangement}', [ArrangementController::class, 'destroy']);
Route::post('/arrangement/store', [ArrangementController::class, 'store']);

#promotion-routes

Route::get('/promotion', [PromotionController::class,'index']);
Route::get('/promotion/{id}', [PromotionController::class, 'show']);
Route::patch('/promotion/update/{promotion}', [PromotionController::class, 'update']);
Route::delete('/promotion/destroy/{promotion}', [PromotionController::class, 'destroy']);
Route::post('/promotion/store', [PromotionController::class, 'store']);

#reservation-routes

Route::get('/reservation', [ReservationController::class,'index']);
Route::get('/reservation/{id}', [ReservationController::class, 'show']);
Route::patch('/reservation/update/{reservation}', [ReservationController::class, 'update']);
Route::delete('/reservation/destroy/{reservation}', [ReservationController::class, 'destroy']);
Route::post('/reservation/store', [ReservationController::class, 'store']);


