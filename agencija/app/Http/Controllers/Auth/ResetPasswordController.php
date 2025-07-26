<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email', 
            'password' => 'required|confirmed|min:8', 

        ]);

        //da li je korisnik autentifikovan putem tokena
        $user = Auth::user(); 

        //da li email koji je poslat odgovara autentifikovanom korisniku

        if (!$user || $user->email !== $validated['email']) {
            return response()->json(['message' => 'Korisnik sa datim emailom nije pronađen.'], 404);
        }

        $user->password = Hash::make($validated['password']); 
        $user->save(); 

        return response()->json(['message' => 'Lozinka je uspešno resetovana']);
    }
}
