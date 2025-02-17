<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\PartnerCollection;


class PartnerController extends Controller
{
   
    public function index()
    {
        $partners = Partner::all();
        return new PartnerCollection($partners);
    }

    
    public function create()
    {
        //
    }

    
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

    public function show(Partner $partner)
    {
        return new PartnerResource($partner);
    }

    public function edit(Partner $partner)
    {
        //
    }

   
    public function update(Request $request, Partner $partner)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $partner->update($validatedData);

        return response()->json([
            'message' => 'Partner updated successfully',
            'partner' => $partner,
        ], 200);
    }


    public function destroy(Partner $partner)
    {
        $partner->delete(); 
        return response()->json(['message' => 'Partner deleted successfully'], 200);
    }
}
