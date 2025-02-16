<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the admins.
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string', // role for admin (might be 'admin' in this case)
            ]);
    
            // Create admin
            $admin = Admin::create($validated);
    
            return response()->json($admin, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified admin.
     */
    public function show($admin_id)
    {
        $admin = Admin::find($admin_id);
        if (is_null($admin)) {
            return response()->json('Admin not found', 404);
        }
        return response()->json($admin);
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $admin->update($validated); 
        return response()->json([
            'message' => 'Admin updated successfully',
            'admin' => $admin,
        ], 200);
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(Admin $admin)
    {
        if (!$admin) {
            return response()->json(['error' => 'Admin not found'], 404); 
        }

        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
