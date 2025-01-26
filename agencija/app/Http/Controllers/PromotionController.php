<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::all();
        return $promotions;
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
                
                'discount' => 'required|numeric',
              
            ]);
    
            // Kreiranje klijenta
            $promotion = Promotion::create($validated);
    
            return response()->json($promotion, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($promotion_id)
    {
        $promotion = Promotion::find($promotion_id);
        if (is_null($promotion)){
            return response()->json('Data not found', 404);
        }
        return response()->json($promotion);     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'discount' => 'required|numeric'
        ]);

        // Ažuriraj podatke
        $promotion->update($validated);

        // Pozovi fresh() da bi vratio ažurirani objekat
        $promotion = $promotion->fresh();

        return response()->json([
            'message' => 'Promotion updated successfully',
            'promotion' => $promotion,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404); 
        }

        $promotion->delete();
        return response()->json(['message' => 'Promotion deleted successfully'], 200);
    }
}
