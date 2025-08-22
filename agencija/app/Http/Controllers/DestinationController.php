<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return $destinations;
    }

    public function create()
    {
        //
    }


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


    public function show($id)
    {
        $destination = Destination::find($id);

        if (!$destination) {
            return response()->json(['message' => 'Destination not found'], 404);
        }

        return response()->json($destination);
    }

    public function edit(Destination $destination)
    {
        //
    }

    public function update(Request $request, Destination $destination)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $destination->update($validatedData);

        return response()->json([
            'message' => 'Destination updated successfully',
            'destination' => $destination,
        ], 200);
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return response()->json(['message' => 'Destination deleted successfully'], 200);
    }

    public function findGoogleImagesDestinations(Request $request)
    {
        $input = $request->input('q');

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://serpapi.com/search.json', [
            'query' => [
                'q' => $request->input('q'),
                'engine' => 'google_images',
                'ijn' => 0,
                'api_key' => env('SERPAPI_API_KEY')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json($data['images_results'] ?? []);
    }

    public function findEventsInDestination(Request $request)
    {

        $input = $request->input('q');
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://serpapi.com/search.json', [
            'query' => [
                'q' => 'Events in ' . $input,
                'engine' => 'google',
                'google_domain' => 'google.com',
                'gl' => 'us',
                'hl' => 'en',
                'api_key' => env('SERPAPI_API_KEY')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json($data['organic_results'] ?? []);
    }
}
