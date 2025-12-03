<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    /**
     * Listar pagos del usuario autenticado
     * GET /api/pagos
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Pago::with(['contratacion.servicio'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->orderBy('fecha_pago', 'desc');

        // Filtrar por estado
        if ($request->has('estado')) {
            $query->where('estado_pago', $request->estado);
        }

        $pagos = $query->get();

        return response()->json([
            'success' => true,
            'data' => $pagos->map(function ($pago) {
                return [
                    'id' => $pago->id,
                    'servicio' => $pago->contratacion->servicio->nombre_servicio,
                    'monto' => (float) $pago->monto_pagado,
                    'monto_formateado' => '$' . number_format($pago->monto_pagado, 2),
                    'fecha_pago' => $pago->fecha_pago->format('Y-m-d'),
                    'tipo_pago' => $pago->tipo_pago,
                    'estado' => $pago->estado_pago,
                ];
            }),
            'resumen' => [
                'total_pagos' => $pagos->count(),
                'pagados' => $pagos->where('estado_pago', 'pagado')->count(),
                'pendientes' => $pagos->where('estado_pago', 'pendiente')->count(),
                'vencidos' => $pagos->where('estado_pago', 'vencido')->count(),
                'monto_total_pagado' => (float) $pagos->where('estado_pago', 'pagado')->sum('monto_pagado'),
                'monto_pendiente' => (float) $pagos->whereIn('estado_pago', ['pendiente', 'vencido'])->sum('monto_pagado'),
            ],
        ]);
    }

    /**
     * Obtener detalle de un pago
     * GET /api/pagos/{id}
     */
    public function show(Request $request, string $id)
    {
        $user = $request->user();

        $pago = Pago::with(['contratacion.servicio'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->where('id', $id)
            ->first();

        if (!$pago) {
            return response()->json([
                'success' => false,
                'message' => 'Pago no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pago->id,
                'contratacion_id' => $pago->id_contratacion,
                'servicio' => [
                    'nombre' => $pago->contratacion->servicio->nombre_servicio,
                    'tipo' => $pago->contratacion->servicio->tipo_servicio,
                ],
                'monto' => (float) $pago->monto_pagado,
                'monto_formateado' => '$' . number_format($pago->monto_pagado, 2),
                'fecha_pago' => $pago->fecha_pago->format('Y-m-d'),
                'tipo_pago' => $pago->tipo_pago,
                'estado' => $pago->estado_pago,
                'created_at' => $pago->created_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /**
     * Descargar comprobante de pago en PDF
     * GET /api/pagos/{id}/comprobante
     */
    public function comprobante(Request $request, string $id)
    {
        $user = $request->user();

        $pago = Pago::with(['contratacion.servicio'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->where('id', $id)
            ->where('estado_pago', 'pagado')
            ->first();

        if (!$pago) {
            return response()->json([
                'success' => false,
                'message' => 'Comprobante no disponible. El pago debe estar pagado.',
            ], 404);
        }

        $pdf = Pdf::loadView('pdf.comprobante-pago', [
            'pago' => $pago,
            'usuario' => $user,
            'servicio' => $pago->contratacion->servicio,
        ]);

        return $pdf->download("comprobante-{$pago->id}.pdf");
    }

    /**
     * Procesar un pago
     * POST /api/pagos/{id}/pagar
     */
    public function pagar(Request $request, string $id)
    {
        $request->validate([
            'tipo_pago' => 'required|in:efectivo,tarjeta,linea',
        ]);

        $user = $request->user();

        $pago = Pago::with(['contratacion.servicio'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->where('id', $id)
            ->first();

        if (!$pago) {
            return response()->json([
                'success' => false,
                'message' => 'Pago no encontrado',
            ], 404);
        }

        if ($pago->estado_pago === 'pagado') {
            return response()->json([
                'success' => false,
                'message' => 'Este pago ya fue procesado',
            ], 400);
        }

        // Actualizar el pago
        $pago->update([
            'estado_pago' => 'pagado',
            'tipo_pago' => $request->tipo_pago,
            'fecha_pago' => now(),
        ]);

        // Activar la contratación si todos los pagos están pagados
        $contratacion = $pago->contratacion;
        $pagosPendientes = $contratacion->pagos()
            ->whereIn('estado_pago', ['pendiente', 'vencido'])
            ->count();

        if ($pagosPendientes === 0 && $contratacion->estado_contratacion === 'pendiente') {
            $contratacion->update(['estado_contratacion' => 'activo']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pago realizado correctamente',
            'data' => [
                'id' => $pago->id,
                'servicio' => $pago->contratacion->servicio->nombre_servicio,
                'monto' => (float) $pago->monto_pagado,
                'monto_formateado' => '$' . number_format($pago->monto_pagado, 2),
                'fecha_pago' => $pago->fecha_pago->format('Y-m-d'),
                'tipo_pago' => $pago->tipo_pago,
                'estado' => $pago->estado_pago,
                'contratacion_activa' => $contratacion->estado_contratacion === 'activo',
            ],
        ]);
    }
}
