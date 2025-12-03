<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\ContratacionController;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\CursoController;

/*
|--------------------------------------------------------------------------
| API Routes - Escuela de Trailers
|--------------------------------------------------------------------------
|
| Todas las rutas requieren autenticación excepto /login
| Base URL: /api
|
*/

// ========================================
// RUTA PÚBLICA (sin autenticación)
// ========================================
Route::post('/login', [AuthController::class, 'login']);

// ========================================
// RUTAS PROTEGIDAS (requieren autenticación)
// ========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // --- Autenticación ---
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/perfil', [AuthController::class, 'perfil']);
    Route::put('/perfil', [AuthController::class, 'actualizarPerfil']);

    // --- Dashboard (resumen) ---
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // --- Servicios ---
    Route::get('/servicios', [ServicioController::class, 'index']);
    Route::get('/servicios/{id}', [ServicioController::class, 'show']);

    // --- Contrataciones ---
    Route::get('/contrataciones', [ContratacionController::class, 'index']);
    Route::post('/contrataciones', [ContratacionController::class, 'store']);
    Route::get('/contrataciones/{id}', [ContratacionController::class, 'show']);

    // --- Pagos ---
    Route::get('/pagos', [PagoController::class, 'index']);
    Route::get('/pagos/{id}', [PagoController::class, 'show']);
    Route::post('/pagos/{id}/pagar', [PagoController::class, 'pagar']);
    Route::get('/pagos/{id}/comprobante', [PagoController::class, 'comprobante']);

    // --- Cursos y Progreso ---
    Route::get('/cursos', [CursoController::class, 'index']);
    Route::get('/cursos/{id}/progreso', [CursoController::class, 'progreso']);
});
