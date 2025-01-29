<?php

namespace App\Http\Controllers;

use App\Models\Arrangement;
use Illuminate\Http\Request;

class ArrangementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrangements = Arrangement::all();
        return $arrangements;
    }

    public function filteredIndex(Request $request)
{
    $query = Arrangement::query();

    // Filtriranje po minimalnoj i maksimalnoj ceni
    if ($request->has('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }

    if ($request->has('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    // Filtriranje po nazivu destinacije
    if ($request->has('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Sortiranje po ceni
    if ($request->has('sort')) {
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        }
    }

    // Paginacija (10 aranžmana po stranici)
    $arrangements = $query->paginate(10);

    return response()->json($arrangements);
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
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'date' => 'required|date',
                'description' => 'required|string'
            ]);
    
            // Kreiranje klijenta
            $arrangement = Arrangement::create($validated);
    
            return response()->json($arrangement, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($arrangement_id)
    {
        $arrangement = Arrangement::find($arrangement_id);
        if (is_null($arrangement)){
            return response()->json('Data not found', 404);
        }
        return response()->json($arrangement);     

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arrangement $arrangement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Arrangement $arrangement)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'required|string'
        ]);

        // Ažuriraj podatke
        $arrangement->update($validated);

        // Pozovi fresh() da bi vratio ažurirani objekat
        $arrangement = $arrangement->fresh();

        return response()->json([
            'message' => 'Arrangement updated successfully',
            'arrangement' => $arrangement,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arrangement $arrangement)
    {
        if (!$arrangement) {
            return response()->json(['error' => 'Client not found'], 404); 
        }

        $arrangement->delete();
        return response()->json(['message' => 'Arrangement deleted successfully'], 200);
    }
}
