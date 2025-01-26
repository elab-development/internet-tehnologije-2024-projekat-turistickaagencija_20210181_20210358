<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::all();
        return $destinations;
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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255'
            ]);
    
            
            $destination = Destination::create($validated);
    
            return response()->json($destination, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $destination = Destination::find($id);

        // Ako destinacija nije pronađena, vratiti 404 odgovor
        if (!$destination) {
            return response()->json(['message' => 'Destination not found'], 404);
        }

        // Ako je pronađena, vratiti podatke o destinaciji
        return response()->json($destination);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        // Validacija ulaznih podataka
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Ažuriranje partnera
        $destination->update($validatedData);

        return response()->json([
            'message' => 'Destination updated successfully',
            'destination' => $destination,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete(); 
        return response()->json(['message' => 'Destination deleted successfully'], 200);
    }
}
