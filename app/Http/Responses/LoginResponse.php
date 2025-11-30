<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

/**
 * LoginResponse personalizado
 * 
 * Redirige al usuario al dashboard correspondiente según su rol
 * después de un login exitoso.
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
        $redirectPath = $user->getDashboardPath();

        return $request->wantsJson()
            ? new JsonResponse(['two_factor' => false, 'redirect' => $redirectPath], 200)
            : redirect()->intended($redirectPath);
    }
}
