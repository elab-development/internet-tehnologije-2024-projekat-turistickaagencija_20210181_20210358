<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string', 
            ]);
    
            $admin = Admin::create($validated);
    
            return response()->json($admin, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function show($admin_id)
    {
        $admin = Admin::find($admin_id);
        if (is_null($admin)) {
            return response()->json('Admin not found', 404);
        }
        return response()->json($admin);
    }

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

    public function destroy(Admin $admin)
    {
        if (!$admin) {
            return response()->json(['error' => 'Admin not found'], 404); 
        }

        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
