<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

/**
 * LoginResponse personalizado
 * 
 * Redirige al usuario al dashboard correspondiente según su rol
 * después de un login exitoso. Si el usuario no ha verificado su email,
 * lo redirige a la página principal con una modal de verificación.
 */
class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = auth()->user();
        
        // Si es una petición AJAX/API
        if ($request->wantsJson()) {
            return new JsonResponse([
                'two_factor' => false, 
                'redirect' => $user->getDashboardPath(),
                'verified' => $user->hasVerifiedEmail(),
            ], 200);
        }

        // Si el usuario no ha verificado su email, redirigir a home con modal
        if (!$user->hasVerifiedEmail()) {
            return redirect('/')->with('show_verification_modal', true)
                ->with('verification_email', $user->email);
        }

        // Usuario verificado - redirigir a su dashboard
        return redirect()->intended($user->getDashboardPath());
    }
}
