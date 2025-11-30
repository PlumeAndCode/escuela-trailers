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

// Dashboard - Redirige al dashboard correspondiente según el rol
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect(auth()->user()->getDashboardPath());
    })->name('dashboard');
});

// =====================================================================
// RUTAS DE ADMINISTRACIÓN - Solo para administradores
// =====================================================================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user.status',
    'role:administrador',
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminIndex::class)->name('dashboard');
    Route::get('/users', AdminUsers::class)->name('users.index');
    Route::get('/pagos', AdminPagos::class)->name('pagos.index');
    Route::get('/reportes', AdminReportes::class)->name('reportes.index');
    Route::get('/control', AdminControl::class)->name('control.index');
});

// =====================================================================
// RUTAS DE ENCARGADO - Solo para encargados
// =====================================================================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user.status',
    'role:encargado',
])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/', ManagerIndex::class)->name('dashboard');
    Route::get('/lecciones', ManagerLecciones::class)->name('lecciones.index');
    Route::get('/trailers', ManagerTrailers::class)->name('trailers.index');
    Route::get('/reportes', ManagerReportes::class)->name('reportes.index');
});

// =====================================================================
// RUTAS DE CLIENTE - Solo para clientes
// =====================================================================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user.status',
    'role:cliente',
])->prefix('/client')->name('client.')->group(function () {
    Route::get('/dashboard', ClientDashboard::class)->name('dashboard');
    Route::get('/progress', ClientProgress::class)->name('progress');
    Route::get('/payment-history', ClientPaymentHistory::class)->name('payment-history');
    Route::get('/services', ClientServices::class)->name('services');
});