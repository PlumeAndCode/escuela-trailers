<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login y obtener token
     * POST /api/login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        if (!$user->estado_usuario) {
            throw ValidationException::withMessages([
                'email' => ['Tu cuenta ha sido desactivada.'],
            ]);
        }

        // Solo permitir clientes en la app móvil
        if ($user->rol !== 'cliente') {
            throw ValidationException::withMessages([
                'email' => ['Solo los clientes pueden acceder desde la aplicación móvil.'],
            ]);
        }

        $token = $user->createToken($request->device_name ?? 'mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'nombre_completo' => $user->nombre_completo,
                    'email' => $user->email,
                    'telefono' => $user->telefono,
                    'rol' => $user->rol,
                    'email_verificado' => $user->hasVerifiedEmail(),
                    'foto_perfil' => $user->profile_photo_url,
                ],
                'token' => $token,
                'token_type' => 'Bearer',
            ],
        ]);
    }

    /**
     * Cerrar sesión (revocar token actual)
     * POST /api/logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada correctamente',
        ]);
    }

    /**
     * Obtener perfil del usuario autenticado
     * GET /api/perfil
     */
    public function perfil(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'nombre_completo' => $user->nombre_completo,
                'email' => $user->email,
                'telefono' => $user->telefono,
                'rol' => $user->rol,
                'email_verificado' => $user->hasVerifiedEmail(),
                'foto_perfil' => $user->profile_photo_url,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /**
     * Actualizar perfil del usuario
     * PUT /api/perfil
     */
    public function actualizarPerfil(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'nombre_completo' => 'sometimes|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['nombre_completo', 'telefono']));

        return response()->json([
            'success' => true,
            'message' => 'Perfil actualizado correctamente',
            'data' => [
                'id' => $user->id,
                'nombre_completo' => $user->nombre_completo,
                'email' => $user->email,
                'telefono' => $user->telefono,
            ],
        ]);
    }
}
