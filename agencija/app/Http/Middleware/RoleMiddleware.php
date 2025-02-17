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
        $user = Auth::guard('api')->user(); 

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

       
        if ($user->role === 'user') {
            return $next($request); 
        }

        return response()->json(['message' => 'Forbidden'], 403);
    
    }
}
