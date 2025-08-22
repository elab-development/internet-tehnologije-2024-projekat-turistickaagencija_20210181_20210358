<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Reservation::query();

        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $reservations = $query->get();

        return response()->json($reservations);
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'arrangement_id' => 'required|exists:arrangements,id',
            'client_id' => 'required|exists:clients,id'
        ]);

        $reservation = Reservation::create([
            'arrangement_id' => $validated['arrangement_id'],
            'client_id' => $validated['client_id'],
            'status' => 'pending', // Default status
            'date' => now(), // Current date as default
        ]);


        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation,
            'success' => true
        ], 201);
    }

    public function show($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if (is_null($reservation)){
            return response()->json('Data not found', 404);
        }
        return response()->json($reservation);
    }

    public function edit(Reservation $reservation)
    {
        //
    }

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

    public function destroy(Reservation $reservation)
    {
        if (!$reservation) {
            return response()->json(['error' => 'Client not found'], 404); 
        }

        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted successfully'], 200);
    }

    public function findArrangementsByClientId($clientId): \Illuminate\Http\JsonResponse
    {
        $reservations = Reservation::where('client_id', $clientId)->with('arrangement')->get();

        if ($reservations->isEmpty()) {
            return response()->json(['message' => 'No reservations found for this client', 'success' => false], 404);
        }

        return response()->json($reservations);
    }
}
