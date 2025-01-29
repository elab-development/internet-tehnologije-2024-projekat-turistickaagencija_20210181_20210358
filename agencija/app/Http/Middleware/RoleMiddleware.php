<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Ako korisnik nije ulogovan, tretiraj ga kao guest
        if (!$user) {
            if (in_array('guest', $roles)) {
                return $next($request); // Dozvoljava pristup neulogovanim korisnicima
            }
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Ako korisnik ima odgovarajuću ulogu
        if (in_array($user->uloga, $roles)) {
            return $next($request); // Dozvoljava pristup sa odgovarajućom ulogom
        }

        // Ako korisnik nema odgovarajuću ulogu
        return response()->json(['message' => 'Forbidden'], 403);
    }
}
