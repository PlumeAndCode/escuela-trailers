<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Listar todos los servicios activos
     * GET /api/servicios
     */
    public function index(Request $request)
    {
        $query = Servicio::where('estado_servicio', true);

        // Filtrar por tipo de servicio
        if ($request->has('tipo')) {
            $query->where('tipo_servicio', $request->tipo);
        }

        $servicios = $query->orderBy('nombre_servicio')->get();

        return response()->json([
            'success' => true,
            'data' => $servicios->map(function ($servicio) {
                return [
                    'id' => $servicio->id,
                    'nombre' => $servicio->nombre_servicio,
                    'tipo' => $servicio->tipo_servicio,
                    'descripcion' => $servicio->descripcion,
                    'precio' => (float) $servicio->precio,
                    'precio_formateado' => '$' . number_format($servicio->precio, 2),
                ];
            }),
            'tipos_disponibles' => ['curso', 'leccion', 'licencia', 'renta_trailer'],
        ]);
    }

    /**
     * Obtener detalle de un servicio
     * GET /api/servicios/{id}
     */
    public function show(string $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $servicio->id,
                'nombre' => $servicio->nombre_servicio,
                'tipo' => $servicio->tipo_servicio,
                'descripcion' => $servicio->descripcion,
                'precio' => (float) $servicio->precio,
                'precio_formateado' => '$' . number_format($servicio->precio, 2),
                'activo' => $servicio->estado_servicio,
            ],
        ]);
    }
}
