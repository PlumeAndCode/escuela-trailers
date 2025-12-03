<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contratacion;
use App\Models\Pago;
use App\Models\Curso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Obtener resumen del dashboard del usuario
     * GET /api/dashboard
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Contrataciones del usuario
        $contrataciones = Contratacion::with(['servicio'])
            ->where('id_usuario', $user->id)
            ->get();

        // Pagos del usuario
        $pagos = Pago::whereHas('contratacion', function ($q) use ($user) {
            $q->where('id_usuario', $user->id);
        })->get();

        // Cursos del usuario
        $cursos = Curso::with(['lecciones'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->get();

        // Calcular estadísticas
        $serviciosActivos = $contrataciones->where('estado_contratacion', 'activo')->count();
        $pagosPendientes = $pagos->whereIn('estado_pago', ['pendiente', 'vencido'])->count();
        $montoPendiente = $pagos->whereIn('estado_pago', ['pendiente', 'vencido'])->sum('monto_pagado');
        
        // Calcular progreso promedio de cursos
        $progresoPromedio = $cursos->count() > 0 
            ? $cursos->avg('avance_porcentaje') 
            : 0;

        // Próximos pagos (pendientes ordenados por fecha)
        $proximosPagos = Pago::with(['contratacion.servicio'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->whereIn('estado_pago', ['pendiente', 'vencido'])
            ->orderBy('fecha_pago')
            ->take(5)
            ->get()
            ->map(function ($pago) {
                return [
                    'id' => $pago->id,
                    'servicio' => $pago->contratacion->servicio->nombre_servicio,
                    'monto' => (float) $pago->monto_pagado,
                    'monto_formateado' => '$' . number_format($pago->monto_pagado, 2),
                    'fecha' => $pago->fecha_pago->format('Y-m-d'),
                    'estado' => $pago->estado_pago,
                    'vencido' => $pago->estado_pago === 'vencido',
                ];
            });

        // Servicios activos recientes
        $serviciosRecientes = $contrataciones
            ->whereIn('estado_contratacion', ['activo', 'pendiente'])
            ->sortByDesc('fecha_contratacion')
            ->take(5)
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'servicio' => $c->servicio->nombre_servicio,
                    'tipo' => $c->servicio->tipo_servicio,
                    'estado' => $c->estado_contratacion,
                    'fecha' => $c->fecha_contratacion->format('Y-m-d'),
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'data' => [
                'usuario' => [
                    'nombre' => $user->nombre_completo,
                    'email' => $user->email,
                ],
                'estadisticas' => [
                    'servicios_activos' => $serviciosActivos,
                    'total_contrataciones' => $contrataciones->count(),
                    'pagos_pendientes' => $pagosPendientes,
                    'monto_pendiente' => (float) $montoPendiente,
                    'monto_pendiente_formateado' => '$' . number_format($montoPendiente, 2),
                    'cursos_inscritos' => $cursos->count(),
                    'progreso_promedio' => round($progresoPromedio, 1),
                ],
                'proximos_pagos' => $proximosPagos,
                'servicios_recientes' => $serviciosRecientes,
            ],
        ]);
    }
}
