<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware: CheckUserStatus
 * 
 * Verifica que el usuario autenticado tenga estado_usuario = true.
 * Si el usuario está inactivo, cierra la sesión y redirige al login
 * con un mensaje de error apropiado.
 */
class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verificar si el usuario está activo
            if (!$user->estado_usuario) {
                // Cerrar sesión del usuario inactivo
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Redirigir al login con mensaje de error
                return redirect()->route('login')
                    ->withErrors(['email' => __('auth.inactive')]);
            }
        }

        return $next($request);
    }
}
