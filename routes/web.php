<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas de administración - Solo para administradores
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:administrador',
])->prefix('/admin')->name('admin.')->group(function () {
    // Aquí irán las rutas de administración
});

// Rutas de gestión - Para encargados
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:encargado',
])->prefix('/manager')->name('manager.')->group(function () {
    // Aquí irán las rutas de encargado
});

// Rutas de cliente
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:cliente',
])->prefix('/client')->name('client.')->group(function () {
    // Aquí irán las rutas de cliente
});

