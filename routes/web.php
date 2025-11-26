<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Index as AdminIndex;
use App\Livewire\Admin\Users as AdminUsers;
use App\Livewire\Admin\Pagos as AdminPagos;
use App\Livewire\Admin\Reportes as AdminReportes;
use App\Livewire\Admin\Control as AdminControl;
use App\Livewire\Manager\Index as ManagerIndex;
use App\Livewire\Manager\Lecciones as ManagerLecciones;
use App\Livewire\Manager\Trailers as ManagerTrailers;
use App\Livewire\Manager\Pagos as ManagerPagos;
use App\Livewire\Manager\Reportes as ManagerReportes;
use App\Livewire\Client\ClientDashboard as ClientDashboard;
use App\Livewire\Client\ClientProgress as ClientProgress;
use App\Livewire\Client\ClientPaymentHistory as ClientPaymentHistory;
use App\Livewire\Client\ClientServices as ClientServices;

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

// Rutas de administración - Solo para administradores - USANDO MIDDLEWARE PARA LOS ROLES
/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:administrador',
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard'); 
    Route::get('/usuarios', Users::class)->name('users');
});
*/

//Rutas de administración mientras no hay conexión con la base de datos
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminIndex::class)->name('dashboard');
    Route::get('/users', AdminUsers::class)->name('users.index');
    Route::get('/pagos', AdminPagos::class)->name('pagos.index');
    Route::get('/reportes', AdminReportes::class)->name('reportes.index');
    Route::get('/control', AdminControl::class)->name('control.index');
});

// Rutas de gestión - Para encargados
/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:encargado',
])->prefix('/manager')->name('manager.')->group(function () {
    // Aquí irán las rutas de encargado
});
*/

//Rutas de encargado mientras no hay conexión con la base de datos
Route::prefix('manager')->name('manager.')->group(function () {
    Route::get('/', ManagerIndex::class)->name('dashboard');
    Route::get('/lecciones', ManagerLecciones::class)->name('lecciones.index');
    Route::get('/trailers', ManagerTrailers::class)->name('trailers.index');
    Route::get('/reportes', ManagerReportes::class)->name('reportes.index');
});

// =====================================================================
// RUTAS DE CLIENTE - SIN AUTENTICACIÓN (PARA TESTING TEMPORAL)
// =====================================================================
Route::prefix('/client')->name('client.')->group(function () {
    Route::get('/dashboard', ClientDashboard::class)->name('dashboard');
    Route::get('/progress', ClientProgress::class)->name('progress');
    Route::get('/payment-history', ClientPaymentHistory::class)->name('payment-history');
    Route::get('/services', ClientServices::class)->name('services');
});

// =====================================================================
// RUTAS DE CLIENTE - CON AUTENTICACIÓN (COMENTADAS TEMPORALMENTE)
// =====================================================================
/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:cliente',
])->prefix('/client')->name('client.')->group(function () {
    Route::get('/dashboard', ClientDashboard::class)->name('dashboard');
    Route::get('/progress', ClientProgress::class)->name('progress');
    Route::get('/payment-history', ClientPaymentHistory::class)->name('payment-history');
    Route::get('/services', ClientServices::class)->name('services');
});
*/