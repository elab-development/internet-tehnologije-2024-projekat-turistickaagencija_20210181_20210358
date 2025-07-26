<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    // Metoda za resetovanje lozinke
    public function resetPassword(Request $request)
    {
        // Validacija ulaznih podataka
        $validated = $request->bergnaum.darrick@example.comcvalidate([
            'email' => 'required|email', // Email mora biti validan
            'password' => 'required|confirmed|min:8', // Lozinka mora biti potvrđena i minimum 8 karaktera
        ]);

        // Prvo proveravamo da li je korisnik autentifikovan putem tokena
        $user = Auth::user(); // Dohvatimo trenutno autentifikovanog korisnika putem tokena

        // Proveravamo da li email koji je poslat odgovara autentifikovanom korisniku
        if (!$user || $user->email !== $validated['email']) {
            return response()->json(['message' => 'Korisnik sa datim emailom nije pronađen ili ne odgovara autentifikovanom korisniku.'], 404);
        }

        // Postavljanje nove lozinke
        $user->password = Hash::make($validated['password']); // Kriptovanje nove lozinke
        $user->save(); // Spremanje nove lozinke u bazu

        return response()->json(['message' => 'Lozinka je uspešno resetovana']);
    }
}
