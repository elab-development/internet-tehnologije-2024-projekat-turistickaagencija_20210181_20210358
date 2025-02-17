<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\AuthController;
use App\Models\Admin;
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin-api')->user(); // Koristi odgovarajući guard

        if (!$user || $user->role !== 'admin') {
            return response()->json(['message' => 'Access Denied. Only admins are allowed.'], 403);
        }

        return $next($request);
    }
}
