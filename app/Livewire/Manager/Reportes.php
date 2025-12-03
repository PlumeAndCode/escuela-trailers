<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use App\Models\AvanceLeccion;
use App\Models\LeccionIndividual;
use App\Models\RentaTrailer;
use App\Models\Pago;
use App\Models\Contratacion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Reportes extends Component
{
    public $tabActivo = 'lecciones';

    /**
     * Obtener progreso de cursos por alumno (con porcentaje real)
     */
    public function getProgresoLeccionesProperty()
    {
        return Contratacion::with(['usuario', 'servicio', 'curso.lecciones', 'avancesLeccion'])
            ->where('estado_contratacion', 'activo')
            ->whereHas('servicio', function ($q) {
                $q->where('tipo_servicio', 'curso');
            })
            ->whereHas('curso')
            ->orderBy('fecha_contratacion', 'asc')
            ->get()
            ->map(function ($contratacion) {
                $totalLecciones = $contratacion->curso->lecciones->count();
                $completadas = $contratacion->avancesLeccion
                    ->whereIn('estado_avance', ['vista', 'pagada'])
                    ->count();
                $porcentaje = $totalLecciones > 0 ? round(($completadas / $totalLecciones) * 100) : 0;
                
                return (object)[
                    'alumno' => $contratacion->usuario?->nombre_completo ?? 'N/A',
                    'servicio' => $contratacion->servicio?->nombre_servicio ?? 'N/A',
                    'total_lecciones' => $totalLecciones,
                    'completadas' => $completadas,
                    'pendientes' => $totalLecciones - $completadas,
                    'porcentaje' => $porcentaje,
                ];
            });
    }

    /**
     * Obtener lecciones individuales (no pertenecen a un curso)
     */
    public function getLeccionesIndividualesProperty()
    {
        return LeccionIndividual::with(['contratacion.usuario', 'contratacion.servicio'])
            ->orderBy('fecha_programada', 'desc')
            ->get();
    }

    /**
     * Datos para gráfica de lecciones individuales
     */
    public function getDatosGraficaLeccionesIndividualesProperty()
    {
        $datos = DB::table('lecciones_individuales')
            ->select(
                'estado_leccion',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('estado_leccion')
            ->pluck('total', 'estado_leccion')
            ->toArray();

        return [
            'labels' => ['Pendiente', 'En Progreso', 'Vista', 'Pagada'],
            'data' => [
                $datos['pendiente'] ?? 0,
                $datos['en_progreso'] ?? 0,
                $datos['vista'] ?? 0,
                $datos['pagada'] ?? 0,
            ],
            'colors' => ['#f59e0b', '#3b82f6', '#8b5cf6', '#10b981'],
        ];
    }

    /**
     * Obtener todas las rentas
     */
    public function getRentasActivasProperty()
    {
        return RentaTrailer::with([
            'trailer',
            'contratacion.usuario'
        ])
        ->orderByRaw("CASE estado_renta WHEN 'activa' THEN 1 WHEN 'atrasada' THEN 2 WHEN 'devuelta' THEN 3 END")
        ->orderBy('fecha_devolucion_estimada')
        ->get()
        ->map(function ($renta) {
            $diasRestantes = $renta->fecha_devolucion_estimada 
                ? (int) now()->diffInDays($renta->fecha_devolucion_estimada, false) 
                : null;
            $renta->dias_restantes = $diasRestantes;
            $renta->proximo_vencer = $renta->estado_renta === 'activa' && $diasRestantes !== null && $diasRestantes <= 3;
            return $renta;
        });
    }

    /**
     * Obtener pagos pendientes
     */
    public function getPagosPendientesProperty()
    {
        return Pago::with([
            'contratacion.usuario',
            'contratacion.servicio'
        ])
        ->whereIn('estado_pago', ['pendiente', 'parcial', 'vencido'])
        ->orderBy('fecha_pago')
        ->get();
    }

    /**
     * Datos para gráfica de lecciones (estado de avance)
     */
    public function getDatosGraficaLeccionesProperty()
    {
        $datos = DB::table('avance_leccion')
            ->select(
                'estado_avance',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('estado_avance')
            ->pluck('total', 'estado_avance')
            ->toArray();

        return [
            'labels' => ['Pendiente', 'En Progreso', 'Vista', 'Pagada'],
            'data' => [
                $datos['pendiente'] ?? 0,
                $datos['en_progreso'] ?? 0,
                $datos['vista'] ?? 0,
                $datos['pagada'] ?? 0,
            ],
            'colors' => ['#f59e0b', '#3b82f6', '#8b5cf6', '#10b981'],
        ];
    }

    /**
     * Datos para gráfica de rentas (estado)
     */
    public function getDatosGraficaRentasProperty()
    {
        $datos = DB::table('rentas_trailer')
            ->select(
                'estado_renta',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('estado_renta')
            ->pluck('total', 'estado_renta')
            ->toArray();

        return [
            'labels' => ['Activa', 'Devuelta', 'Atrasada'],
            'data' => [
                $datos['activa'] ?? 0,
                $datos['devuelta'] ?? 0,
                $datos['atrasada'] ?? 0,
            ],
            'colors' => ['#3b82f6', '#10b981', '#ef4444'],
        ];
    }

    /**
     * Datos para gráfica de pagos
     */
    public function getDatosGraficaPagosProperty()
    {
        $datos = DB::table('pagos')
            ->select(
                'estado_pago',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('estado_pago')
            ->pluck('total', 'estado_pago')
            ->toArray();

        return [
            'labels' => ['Pendiente', 'Parcial', 'Pagado', 'Vencido'],
            'data' => [
                $datos['pendiente'] ?? 0,
                $datos['parcial'] ?? 0,
                $datos['pagado'] ?? 0,
                $datos['vencido'] ?? 0,
            ],
            'colors' => ['#fbbf24', '#f97316', '#22c55e', '#ef4444'],
        ];
    }

    /**
     * Cambiar tab activo
     */
    public function cambiarTab($tab)
    {
        $this->tabActivo = $tab;
        $this->dispatch('tabChanged');
    }

    /**
     * Exportar reporte de lecciones a PDF
     */
    public function exportarLeccionesPDF()
    {
        $progresoLecciones = $this->progresoLecciones;
        $leccionesIndividuales = $this->leccionesIndividuales;
        
        $pdf = Pdf::loadView('pdf.manager.reporte-lecciones', [
            'progresoLecciones' => $progresoLecciones,
            'leccionesIndividuales' => $leccionesIndividuales,
            'fecha' => now()->format('d/m/Y H:i'),
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'reporte-lecciones-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    /**
     * Exportar reporte de rentas a PDF
     */
    public function exportarRentasPDF()
    {
        $rentasActivas = $this->rentasActivas;
        
        $pdf = Pdf::loadView('pdf.manager.reporte-rentas', [
            'rentasActivas' => $rentasActivas,
            'fecha' => now()->format('d/m/Y H:i'),
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'reporte-rentas-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    /**
     * Exportar reporte de pagos a PDF
     */
    public function exportarPagosPDF()
    {
        $pagosPendientes = $this->pagosPendientes;
        
        $pdf = Pdf::loadView('pdf.manager.reporte-pagos', [
            'pagosPendientes' => $pagosPendientes,
            'fecha' => now()->format('d/m/Y H:i'),
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'reporte-pagos-pendientes-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    public function render()
    {
        return view('livewire.manager.reportes', [
            'progresoLecciones' => $this->progresoLecciones,
            'leccionesIndividuales' => $this->leccionesIndividuales,
            'rentasActivas' => $this->rentasActivas,
            'pagosPendientes' => $this->pagosPendientes,
            'datosGraficaLecciones' => $this->datosGraficaLecciones,
            'datosGraficaLeccionesIndividuales' => $this->datosGraficaLeccionesIndividuales,
            'datosGraficaRentas' => $this->datosGraficaRentas,
            'datosGraficaPagos' => $this->datosGraficaPagos,
        ])->layout('layouts.manager');
    }
}