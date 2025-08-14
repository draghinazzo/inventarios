<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::guard('api')->user();

        if (!$user || $user->rol !== $role) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        return $next($request);
    }
}

