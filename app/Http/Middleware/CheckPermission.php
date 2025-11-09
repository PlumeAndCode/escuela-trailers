<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        if (! Auth::check()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthorized'], 401)
                : redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user is active
        if (! $user->estado_usuario) {
            Auth::logout();
            return $request->expectsJson()
                ? response()->json(['message' => 'Usuario inactivo'], 403)
                : redirect()->route('login')->with('error', 'Usuario inactivo');
        }

        // Check if user has one of the required permissions
        foreach ($permissions as $permission) {
            if ($user->hasPermissionTo($permission)) {
                return $next($request);
            }
        }

        return $request->expectsJson()
            ? response()->json(['message' => 'Forbidden - insufficient permissions'], 403)
            : abort(403, 'Forbidden - insufficient permissions');
    }
}
