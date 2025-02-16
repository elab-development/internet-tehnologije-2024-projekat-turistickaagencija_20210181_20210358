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
use App\Http\Controllers\API\AuthController;
use App\Http\Client;
use App\Http\Middleware\RoleMiddleware; 

Route::get('/client', function (Request $request) {
    return $request->client();
})->middleware('auth:sanctum');

/*protected $routeMiddleware = [
    // Ostali middleware
    'role' => \App\Http\Middleware\RoleMiddleware::class,  // Dodaj ovo
];*/

/**
 * =============================
 *   1. JAVNE RUTE (dostupne svima)
 * =============================
 */
Route::get('/destination', [DestinationController::class, 'index']);
Route::get('/destination/{id}', [DestinationController::class, 'show']);
Route::get('/arrangement', [ArrangementController::class, 'index']);
Route::get('/arrangement/{id}', [ArrangementController::class, 'show']);
Route::get('/promotion', [PromotionController::class, 'index']);
Route::get('/promotion/{id}', [PromotionController::class, 'show']);

// Autentifikacija
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * =====================================
 *   2. RUTE KOJE ZAHTEVAJU AUTENTIFIKACIJU
 * =====================================
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    })->name('profile'); // ✅ Imenovana ruta

    Route::post('/reservation/store', [ReservationController::class, 'store']);
    Route::delete('/reservation/destroy/{reservation}', [ReservationController::class, 'destroy']);
});

/**
 * =====================================
 *   3. RUTE ZA REGISTROVANE KORISNIKE (ROLE: USER)
 * =====================================
 */
Route::group(['middleware' => ['auth:sanctum', 'role:user']], function () {
    Route::get('/reservation', [ReservationController::class, 'index']);
    Route::get('/reservation/{id}', [ReservationController::class, 'show']);
});

// Ove rute su dostupne korisnicima sa rokom 'agent'
Route::group(['middleware' => ['auth:sanctum', 'role:agent']], function () {
    Route::resource('client', ClientController::class)->only(['index', 'show']);  // Pregled klijenata
    Route::resource('partner', PartnerController::class)->only(['index', 'show']); // Pregled partnera
    Route::resource('reservation', ReservationController::class)->only(['index', 'show']);  // Pregled rezervacija
});


// RUTE ZA ADMINISTRATORE (sa role middleware)
// Ove rute su dostupne samo korisnicima sa rokom 'admin'
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::resource('client', ClientController::class)->only(['index', 'show', 'store', 'update', 'destroy']);  // Admin može dodati, ažurirati i obrisati klijente
    Route::resource('partner', PartnerController::class)->only(['index', 'show', 'store', 'update', 'destroy']); // Admin može dodati, ažurirati i obrisati partnere
    Route::resource('reservation', ReservationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);  // Admin može dodati, ažurirati i obrisati rezervacije
    Route::resource('promotion', PromotionController::class)->only([ 'store', 'update', 'destroy']);  // Admin može dodati, ažurirati i obrisati promocije
    Route::resource('arrangement', ArrangementController::class)->only(['store', 'update', 'destroy']);  // Admin može dodati, ažurirati i obrisati aranžmane
    Route::resource('destination', DestinationController::class)->only(['store', 'update', 'destroy']);  // Admin može dodati, ažurirati i obrisati destinacije
});


/**
 * =============================
 *   6. FALLBACK RUTA
 * =============================
 */
Route::fallback(function () {
    return response()->json(['error' => 'Stranica nije pronađena'], 404);
});



















