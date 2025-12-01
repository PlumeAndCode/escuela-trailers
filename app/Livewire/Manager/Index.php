<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use App\Models\User;
use App\Models\Curso;
use App\Models\Leccion;
use App\Models\Contratacion;
use App\Models\Pago;
use App\Models\Trailer;
use App\Models\RentaTrailer;
use App\Models\AvanceLeccion;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    // Estadísticas del Dashboard
    public function getEstadisticasProperty()
    {
        return [
            'estudiantes_activos' => User::where('rol', 'cliente')
                ->where('estado_usuario', true)
                ->count(),
            'cursos_activos' => Curso::whereHas('contratacion', function ($q) {
                $q->where('estado_contratacion', 'activo');
            })->count(),
            'lecciones_impartidas' => AvanceLeccion::whereIn('estado_avance', ['vista', 'pagada'])->count(),
            'trailers_disponibles' => Trailer::where('estado_trailer', 'disponible')
                ->whereNotIn('id', RentaTrailer::where('estado_renta', 'activa')->pluck('id_trailer'))
                ->count(),
            'trailers_rentados' => RentaTrailer::where('estado_renta', 'activa')->count(),
            'pagos_pendientes' => Pago::where('estado_pago', 'pendiente')->sum('monto_pagado'),
            'contrataciones_activas' => Contratacion::where('estado_contratacion', 'activo')->count(),
        ];
    }

    // Progreso de cursos - basado en contrataciones activas de tipo curso
    public function getProximasLeccionesProperty()
    {
        return Contratacion::with(['usuario', 'servicio', 'curso.lecciones', 'avancesLeccion'])
            ->where('estado_contratacion', 'activo')
            ->whereHas('servicio', function ($q) {
                $q->where('tipo_servicio', 'curso');
            })
            ->whereHas('curso') // Solo contrataciones que tengan un curso asociado
            ->orderBy('fecha_contratacion', 'asc')
            ->take(5)
            ->get()
            ->map(function ($contratacion) {
                // Total de lecciones del curso
                $totalLecciones = $contratacion->curso->lecciones->count();
                
                // Avances completados (vista o pagada)
                $avance = $contratacion->avancesLeccion
                    ->whereIn('estado_avance', ['vista', 'pagada'])
                    ->count();
                
                // Calcular porcentaje
                $porcentaje = $totalLecciones > 0 ? round(($avance / $totalLecciones) * 100) : 0;
                
                return (object)[
                    'usuario' => $contratacion->usuario?->nombre_completo ?? 'N/A',
                    'servicio' => $contratacion->servicio?->nombre_servicio ?? 'N/A',
                    'fecha' => $contratacion->fecha_contratacion,
                    'progreso' => $porcentaje,
                    'lecciones_completadas' => $avance,
                    'lecciones_total' => $totalLecciones,
                ];
            });
    }

    // Pagos pendientes por cobrar
    public function getPagosPendientesProperty()
    {
        return Pago::with(['contratacion.usuario', 'contratacion.servicio'])
            ->whereIn('estado_pago', ['pendiente', 'vencido'])
            ->orderBy('fecha_pago', 'asc')
            ->take(5)
            ->get();
    }

    // Actividad reciente (últimos cambios)
    public function getActividadRecienteProperty()
    {
        $actividades = collect();

        // Últimas contrataciones
        $contrataciones = Contratacion::with(['usuario', 'servicio'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($c) {
                return (object)[
                    'tipo' => 'contratacion',
                    'descripcion' => "Nueva contratación: {$c->usuario?->nombre_completo} - {$c->servicio?->nombre_servicio}",
                    'fecha' => $c->created_at,
                    'icono' => '📋',
                ];
            });

        // Últimos pagos
        $pagos = Pago::with(['contratacion.usuario'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($p) {
                return (object)[
                    'tipo' => 'pago',
                    'descripcion' => "Pago registrado: {$p->contratacion?->usuario?->nombre_completo} - \${$p->monto_pagado}",
                    'fecha' => $p->created_at,
                    'icono' => '💰',
                ];
            });

        // Últimas rentas
        $rentas = RentaTrailer::with(['trailer', 'contratacion.usuario'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($r) {
                return (object)[
                    'tipo' => 'renta',
                    'descripcion' => "Renta de trailer: {$r->trailer?->modelo} - {$r->contratacion?->usuario?->nombre_completo}",
                    'fecha' => $r->created_at,
                    'icono' => '🚛',
                ];
            });

        return $actividades
            ->concat($contrataciones)
            ->concat($pagos)
            ->concat($rentas)
            ->sortByDesc('fecha')
            ->take(5)
            ->values();
    }

    // Rentas próximas a vencer (próximos 3 días)
    public function getRentasProximasVencerProperty()
    {
        $hoy = Carbon::now();
        $tresDias = Carbon::now()->addDays(3);

        return RentaTrailer::with(['trailer', 'contratacion.usuario'])
            ->where('estado_renta', 'activa')
            ->whereBetween('fecha_devolucion_estimada', [$hoy, $tresDias])
            ->orderBy('fecha_devolucion_estimada', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.manager.index', [
            'estadisticas' => $this->estadisticas,
            'proximasLecciones' => $this->proximasLecciones,
            'pagosPendientes' => $this->pagosPendientes,
            'actividadReciente' => $this->actividadReciente,
            'rentasProximasVencer' => $this->rentasProximasVencer,
        ])->layout('layouts.manager');
    }
}