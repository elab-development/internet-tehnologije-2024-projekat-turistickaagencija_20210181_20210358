<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return $reservations;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validacija za ulazne podatke
    $validated = $request->validate([
        'arrangement_id' => 'required|exists:arrangements,id', // Verifikacija da arrangement_id postoji
        'client_id' => 'required|exists:clients,id', // Verifikacija da client_id postoji
        'status' => 'required|string|in:pending,confirmed,canceled', // Status je obavezan i mora biti jedan od ova tri
        'date' => 'required|date', // Provera da datum bude u validnom formatu
    ]);

    // Kreiranje nove rezervacije
    $reservation = Reservation::create($validated);

    // Vraćanje odgovora sa novom rezervacijom
    return response()->json([
        'message' => 'Reservation created successfully',
        'reservation' => $reservation,
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if (is_null($reservation)){
            return response()->json('Data not found', 404);
        }
        return response()->json($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,canceled',  
            'date' => 'required|date', 
        ]);

        $reservation->update($validated);

        $reservation = $reservation->fresh();

        return response()->json([
            'message' => 'Reservation updated successfully',
            'reservation' => $reservation,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if (!$reservation) {
            return response()->json(['error' => 'Client not found'], 404); 
        }

        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted successfully'], 200);
    }
}
