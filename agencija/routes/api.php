<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PartnerController;
use App\Http\Resources\PartnerResources;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#client-routes

Route::get('/clients', [ClientController::class,'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::post('/clstore', [ClientController::class, 'store']);
Route::delete('/cldestroy/{id}', [ClientController::class, 'destroy']);
Route::put('/clupdate/{id}',[ClientController::class,'update']);

#partner-routes

Route::resource('partner',PartnerController::class);
//Route::resource('partners',PartnerController::class);