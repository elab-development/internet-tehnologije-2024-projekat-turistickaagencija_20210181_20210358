<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\PartnerCollection;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return new PartnerCollection($partners);
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
                'contact' => 'required|string|max:255',
                'type' => 'required|string'
            ]);
    
            
            $partner = Partner::create($validated);
    
            return response()->json($partner, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return new PartnerResource($partner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        // Validacija ulaznih podataka
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        // Ažuriranje partnera
        $partner->update($validatedData);

        return response()->json([
            'message' => 'Partner updated successfully',
            'partner' => $partner,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy($id)
    {
        $partner = Partner::find($id);

        if (!$partner) {
            return response()->json(['error' => 'Partner not found'], 404); 
        }

        $partner->delete();
        return response()->json(['message' => 'Partner deleted successfully'], 200);
    }*/

    public function destroy(Partner $partner)
    {
        $partner->delete(); 
        return response()->json(['message' => 'Partner deleted successfully'], 200);
    }
}
