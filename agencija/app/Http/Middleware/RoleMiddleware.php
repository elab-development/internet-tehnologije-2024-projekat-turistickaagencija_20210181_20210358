<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
       // Dohvati trenutno ulogovanog korisnika
       $user = Auth::user();

       // Ako korisnik nije ulogovan
       if (!$user) {
           return response()->json(['message' => 'Unauthorized'], 401);
       }

       // Ako korisnik ima odgovarajuću ulogu
       if (in_array($user->role, $roles)) {
           return $next($request); // Prolazi dalje u request
       }
        // Ako korisnik ima odgovarajuću ulogu
        if (in_array($user->role, $roles)) { // Ovde koristiš 'role' umesto 'uloga'
            return $next($request); // Dozvoljava pristup sa odgovarajućom ulogom
        }

        // Ako korisnik nema odgovarajuću ulogu
        return response()->json(['message' => 'Forbidden'], 403);
    }
}
