<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\JsonResponse;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Si es una petición AJAX/API, retornar JSON
        if ($request->wantsJson()) {
            return new JsonResponse([
                'success' => true,
                'message' => 'Registro exitoso. Por favor verifica tu correo electrónico.',
            ], 201);
        }

        // Redirigir a home con un flag para mostrar la modal
        return redirect('/')->with('show_verification_modal', true)
            ->with('verification_email', $request->email);
    }
}
