<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return $clients;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|unique:clients,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string'
            ]);
    
            // Kreiranje klijenta
            $client = Client::create($validated);
    
            return response()->json($client, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show($client_id)
    {
        $client = Client::find($client_id);
        if (is_null($client)){
            return response()->json('Data not found', 404);
        }
        return response()->json($client);     

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string'
        ]);

        $client->update($validated); 
        return response()->json([
            'message' => 'Client updated successfully',
            'client' => $client,
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Client $client)
    {

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404); 
        }

        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }

}
