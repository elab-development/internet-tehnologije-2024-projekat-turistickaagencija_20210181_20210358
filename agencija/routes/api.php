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
use App\Http\Middleware\RoleMiddleware; 
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/client', function (Request $request) {
    return $request->client();
})->middleware('auth:sanctum');


//javne rute(dostupne svima)

Route::get('/destination', [DestinationController::class, 'index']);
Route::get('/destination/{id}', [DestinationController::class, 'show']);
Route::get('/arrangement', [ArrangementController::class, 'index']);
Route::get('/arrangement/{id}', [ArrangementController::class, 'show']);
Route::get('/arrangements/filter', [ArrangementController::class, 'filteredIndex']);
Route::get('/promotion', [PromotionController::class, 'index']);
Route::get('/promotion/{id}', [PromotionController::class, 'show']);


//autentifikacija

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/admin', [AuthController::class, 'loginAdmin']);
Route::post('/login/agent', [AuthController::class, 'loginAgent']);



//rute koje zahtevaju autentifikaciju

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    })->name('profile'); // ✅ Imenovana ruta

    Route::post('/password/reset', [ResetPasswordController::class, 'resetPassword']);

});


//rute za registrovane korisnike (role='user')

/*Route::prefix('user')->middleware(['auth:sanctum', 'user'])->group(function () {
    Route::post('/reservation/store', [ReservationController::class, 'store']);
});
*/
Route::middleware(['auth:sanctum'])->post('/user/reservation/store', [ReservationController::class, 'store']);


//rute za registrovane korisnike (role='agent')

Route::prefix('agent')->middleware(['auth:sanctum','agent'])->group(function () {
    Route::resource('client', ClientController::class)->only(['index', 'show']);
    Route::resource('partner', PartnerController::class)->only(['index', 'show']);
    Route::resource('reservation', ReservationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('promotion', PromotionController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('arrangement', ArrangementController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('destination', DestinationController::class)->only(['index', 'show']);
});


//rute za registrovane korisnike (role='admin')

Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('client', ClientController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('partner', PartnerController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('reservation', ReservationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('promotion', PromotionController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('arrangement', ArrangementController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('destination', DestinationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
});


//fallback rute

Route::fallback(function () {
    return response()->json(['error' => 'Stranica nije pronađena'], 404);
});














