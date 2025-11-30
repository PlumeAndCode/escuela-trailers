<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pago;
use App\Models\Contratacion;
use App\Models\Servicio;
use App\Models\Trailer;
use App\Models\Curso;

class Index extends Component
{
    public $user;

    // Estadísticas del Dashboard
    public $totalUsuarios;
    public $usuariosActivos;
    public $usuariosPorRol;
    public $totalIngresosMes;
    public $totalServicios;
    public $serviciosActivos;
    public $trailersDisponibles;
    public $trailersRentados;
    public $trailersMantenimiento;
    public $pagosPendientes;
    public $pagosVencidos;
    public $contratacionesActivas;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadStats();
    }

    /**
     * Carga todas las estadísticas del dashboard
     */
    public function loadStats()
    {
        // Estadísticas de usuarios
        $this->totalUsuarios = User::count();
        $this->usuariosActivos = User::where('estado_usuario', true)->count();
        $this->usuariosPorRol = [
            'cliente' => User::where('rol', 'cliente')->count(),
            'encargado' => User::where('rol', 'encargado')->count(),
            'administrador' => User::where('rol', 'administrador')->count(),
        ];

        // Estadísticas de ingresos del mes actual
        $this->totalIngresosMes = Pago::where('estado_pago', 'pagado')
            ->whereMonth('fecha_pago', now()->month)
            ->whereYear('fecha_pago', now()->year)
            ->sum('monto_pagado');

        // Estadísticas de servicios
        $this->totalServicios = Servicio::count();
        $this->serviciosActivos = Servicio::where('estado_servicio', true)->count();

        // Estadísticas de trailers
        $this->trailersDisponibles = Trailer::where('estado_trailer', 'disponible')->count();
        $this->trailersRentados = Trailer::where('estado_trailer', 'rentado')->count();
        $this->trailersMantenimiento = Trailer::where('estado_trailer', 'mantenimiento')->count();

        // Estadísticas de pagos
        $this->pagosPendientes = Pago::where('estado_pago', 'pendiente')->sum('monto_pagado');
        $this->pagosVencidos = Pago::where('estado_pago', 'vencido')->sum('monto_pagado');

        // Contrataciones activas
        $this->contratacionesActivas = Contratacion::where('estado_contratacion', 'activo')->count();
    }

    /**
     * Obtiene los ingresos de los últimos 6 meses para gráfico
     */
    public function getIngresosUltimosMeses()
    {
        $ingresos = [];
        for ($i = 5; $i >= 0; $i--) {
            $fecha = now()->subMonths($i);
            $total = Pago::where('estado_pago', 'pagado')
                ->whereMonth('fecha_pago', $fecha->month)
                ->whereYear('fecha_pago', $fecha->year)
                ->sum('monto_pagado');
            
            $ingresos[] = [
                'mes' => $fecha->translatedFormat('M'),
                'total' => $total,
            ];
        }
        return $ingresos;
    }

    /**
     * Obtiene las últimas contrataciones
     */
    public function getUltimasContrataciones()
    {
        return Contratacion::with(['usuario', 'servicio'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    /**
     * Obtiene los pagos vencidos (alertas)
     */
    public function getPagosVencidosAlerta()
    {
        return Pago::with(['contratacion.usuario', 'contratacion.servicio'])
            ->where('estado_pago', 'vencido')
            ->orderBy('fecha_pago', 'asc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'user' => $this->user,
            'stats' => [
                'totalUsuarios' => $this->totalUsuarios,
                'usuariosActivos' => $this->usuariosActivos,
                'usuariosPorRol' => $this->usuariosPorRol,
                'totalIngresosMes' => $this->totalIngresosMes,
                'totalServicios' => $this->totalServicios,
                'serviciosActivos' => $this->serviciosActivos,
                'trailersDisponibles' => $this->trailersDisponibles,
                'trailersRentados' => $this->trailersRentados,
                'trailersMantenimiento' => $this->trailersMantenimiento,
                'pagosPendientes' => $this->pagosPendientes,
                'pagosVencidos' => $this->pagosVencidos,
                'contratacionesActivas' => $this->contratacionesActivas,
            ],
            'ingresosMensuales' => $this->getIngresosUltimosMeses(),
            'ultimasContrataciones' => $this->getUltimasContrataciones(),
            'pagosVencidosAlerta' => $this->getPagosVencidosAlerta(),
        ])->layout('layouts.admin');
    }
}