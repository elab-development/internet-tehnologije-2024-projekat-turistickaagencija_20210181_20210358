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
    {  // Provodimo autentifikaciju sa odgovarajućim guard-om za 'user' (client)
        $user = Auth::guard('api')->user(); // Ensure you use the correct guard (e.g., 'api')

        // If the user is not authenticated
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Check if the user's role is 'user'
        if ($user->role === 'user') {
            return $next($request); // Allow the request to proceed
        }

        // If the user does not have the 'user' role
        return response()->json(['message' => 'Forbidden'], 403);
    
    }
}
