<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        // Check if user is active
        if (! $user->estado_usuario) {
            Auth::logout();
            return response()->json(['message' => 'Usuario inactivo'], 403);
        }

        // Check if user has one of the required roles
        if (! in_array($user->rol, $roles)) {
            return response()->json(['message' => 'Forbidden - insufficient permissions'], 403);
        }

        return $next($request);
    }
}
