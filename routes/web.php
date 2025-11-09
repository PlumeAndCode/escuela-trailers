<?php

use Illuminate\Support\Facades\Route;

// Rutas públicas (Tus nuevas rutas)
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/servicios', function () {
    return view('services');
})->name('services');

Route::get('/nosotros', function () {
    return view('about');
})->name('about');

Route::get('/contacto', function () {
    return view('contact');
})->name('contact');

// Ruta original de welcome (puedes mantenerla o redirigir)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

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