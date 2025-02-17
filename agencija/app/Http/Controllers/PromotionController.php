<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return $promotions;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                
                'discount' => 'required|numeric',
              
            ]);
    
            $promotion = Promotion::create($validated);
    
            return response()->json($promotion, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function show($promotion_id)
    {
        $promotion = Promotion::find($promotion_id);
        if (is_null($promotion)){
            return response()->json('Data not found', 404);
        }
        return response()->json($promotion);     
    }

    
    public function edit(Promotion $promotion)
    {
        //
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'discount' => 'required|numeric'
        ]);

        $promotion->update($validated);

        $promotion = $promotion->fresh();

        return response()->json([
            'message' => 'Promotion updated successfully',
            'promotion' => $promotion,
        ], 200);
    }


    public function destroy(Promotion $promotion)
    {
        if (!$promotion) {
            return response()->json(['error' => 'Promotion not found'], 404); 
        }

        $promotion->delete();
        return response()->json(['message' => 'Promotion deleted successfully'], 200);
    }
}
