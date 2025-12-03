<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contratacion;
use App\Models\Servicio;
use App\Models\Pago;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratacionController extends Controller
{
    /**
     * Listar contrataciones del usuario autenticado
     * GET /api/contrataciones
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Contratacion::with(['servicio'])
            ->where('id_usuario', $user->id)
            ->orderBy('fecha_contratacion', 'desc');

        // Filtrar por estado
        if ($request->has('estado')) {
            $query->where('estado_contratacion', $request->estado);
        }

        // Filtrar por tipo de servicio
        if ($request->has('tipo')) {
            $query->whereHas('servicio', function ($q) use ($request) {
                $q->where('tipo_servicio', $request->tipo);
            });
        }

        $contrataciones = $query->get();

        return response()->json([
            'success' => true,
            'data' => $contrataciones->map(function ($contratacion) {
                return [
                    'id' => $contratacion->id,
                    'servicio' => [
                        'id' => $contratacion->servicio->id,
                        'nombre' => $contratacion->servicio->nombre_servicio,
                        'tipo' => $contratacion->servicio->tipo_servicio,
                        'precio' => (float) $contratacion->servicio->precio,
                    ],
                    'fecha_contratacion' => $contratacion->fecha_contratacion->format('Y-m-d'),
                    'estado' => $contratacion->estado_contratacion,
                    'pagos_pendientes' => $contratacion->pagos()->where('estado_pago', 'pendiente')->count(),
                ];
            }),
            'total' => $contrataciones->count(),
        ]);
    }

    /**
     * Obtener detalle de una contratación
     * GET /api/contrataciones/{id}
     */
    public function show(Request $request, string $id)
    {
        $user = $request->user();

        $contratacion = Contratacion::with(['servicio', 'pagos', 'curso.lecciones'])
            ->where('id', $id)
            ->where('id_usuario', $user->id)
            ->first();

        if (!$contratacion) {
            return response()->json([
                'success' => false,
                'message' => 'Contratación no encontrada',
            ], 404);
        }

        $data = [
            'id' => $contratacion->id,
            'servicio' => [
                'id' => $contratacion->servicio->id,
                'nombre' => $contratacion->servicio->nombre_servicio,
                'tipo' => $contratacion->servicio->tipo_servicio,
                'descripcion' => $contratacion->servicio->descripcion,
                'precio' => (float) $contratacion->servicio->precio,
            ],
            'fecha_contratacion' => $contratacion->fecha_contratacion->format('Y-m-d'),
            'estado' => $contratacion->estado_contratacion,
        ];

        // Si es un curso, incluir información del progreso
        if ($contratacion->curso) {
            $data['curso'] = [
                'id' => $contratacion->curso->id,
                'nombre' => $contratacion->curso->nombre_curso,
                'descripcion' => $contratacion->curso->descripcion,
                'avance_porcentaje' => (float) $contratacion->curso->avance_porcentaje,
                'total_lecciones' => $contratacion->curso->lecciones->count(),
                'lecciones_completadas' => $contratacion->curso->lecciones->where('estado', 'completada')->count(),
            ];
        }

        // Incluir resumen de pagos
        $data['pagos'] = [
            'total' => $contratacion->pagos->count(),
            'pagados' => $contratacion->pagos->where('estado_pago', 'pagado')->count(),
            'pendientes' => $contratacion->pagos->where('estado_pago', 'pendiente')->count(),
            'vencidos' => $contratacion->pagos->where('estado_pago', 'vencido')->count(),
            'monto_total' => (float) $contratacion->pagos->sum('monto_pagado'),
            'monto_pagado' => (float) $contratacion->pagos->where('estado_pago', 'pagado')->sum('monto_pagado'),
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Contratar un servicio
     * POST /api/contrataciones
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_servicio' => 'required|uuid|exists:servicios,id',
        ]);

        $user = $request->user();
        $servicio = Servicio::findOrFail($request->id_servicio);

        // Verificar que el servicio esté activo
        if (!$servicio->estado_servicio) {
            return response()->json([
                'success' => false,
                'message' => 'El servicio no está disponible',
            ], 400);
        }

        try {
            DB::beginTransaction();

            // Crear la contratación
            $contratacion = Contratacion::create([
                'id_usuario' => $user->id,
                'id_servicio' => $servicio->id,
                'fecha_contratacion' => now(),
                'estado_contratacion' => 'pendiente',
            ]);

            // Crear un pago por el total del servicio
            $pago = Pago::create([
                'id_contratacion' => $contratacion->id,
                'monto_pagado' => $servicio->precio,
                'fecha_pago' => now()->addDays(7), // Fecha límite: 7 días
                'tipo_pago' => 'efectivo', // Valor por defecto válido
                'estado_pago' => 'pendiente',
            ]);

            // Si es un curso, crear el registro del curso
            if ($servicio->tipo_servicio === 'curso') {
                Curso::create([
                    'id_contratacion' => $contratacion->id,
                    'nombre_curso' => $servicio->nombre_servicio,
                    'descripcion' => $servicio->descripcion,
                    'avance_porcentaje' => 0,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Servicio contratado exitosamente',
                'data' => [
                    'id' => $contratacion->id,
                    'servicio' => [
                        'id' => $servicio->id,
                        'nombre' => $servicio->nombre_servicio,
                        'tipo' => $servicio->tipo_servicio,
                        'precio' => (float) $servicio->precio,
                        'precio_formateado' => '$' . number_format($servicio->precio, 2),
                    ],
                    'fecha_contratacion' => $contratacion->fecha_contratacion->format('Y-m-d'),
                    'estado' => $contratacion->estado_contratacion,
                    'pago' => [
                        'id' => $pago->id,
                        'monto' => (float) $pago->monto_pagado,
                        'monto_formateado' => '$' . number_format($pago->monto_pagado, 2),
                        'fecha_limite' => $pago->fecha_pago->format('Y-m-d'),
                        'estado' => $pago->estado_pago,
                    ],
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al contratar el servicio',
            ], 500);
        }
    }
}
