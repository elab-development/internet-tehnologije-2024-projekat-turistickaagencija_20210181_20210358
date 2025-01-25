<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/clients', [ClientController::class,'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::post('/store', [ClientController::class, 'store']);
Route::delete('/destroy/{id}', [ClientController::class, 'destroy']);
Route::put('/update/{id}',[ClientController::class,'update']);

