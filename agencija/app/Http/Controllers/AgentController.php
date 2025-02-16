<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the agents.
     */
    public function index()
    {
        $agents = Agent::all();
        return response()->json($agents);
    }

    /**
     * Store a newly created agent in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|unique:agents,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string', // role could be optional for agents, might be hardcoded
            ]);
    
            // Create agent
            $agent = Agent::create($validated);
    
            return response()->json($agent, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified agent.
     */
    public function show($agent_id)
    {
        $agent = Agent::find($agent_id);
        if (is_null($agent)) {
            return response()->json('Agent not found', 404);
        }
        return response()->json($agent);
    }

    /**
     * Update the specified agent in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $agent->update($validated); 
        return response()->json([
            'message' => 'Agent updated successfully',
            'agent' => $agent,
        ], 200);
    }

    /**
     * Remove the specified agent from storage.
     */
    public function destroy(Agent $agent)
    {
        if (!$agent) {
            return response()->json(['error' => 'Agent not found'], 404); 
        }

        $agent->delete();
        return response()->json(['message' => 'Agent deleted successfully'], 200);
    }
}

