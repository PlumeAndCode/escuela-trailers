<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Listar cursos del usuario autenticado
     * GET /api/cursos
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $cursos = Curso::with(['contratacion.servicio', 'lecciones'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cursos->map(function ($curso) {
                $totalLecciones = $curso->lecciones->count();
                $leccionesCompletadas = $curso->lecciones->where('estado', 'completada')->count();

                return [
                    'id' => $curso->id,
                    'nombre' => $curso->nombre_curso,
                    'descripcion' => $curso->descripcion,
                    'avance_porcentaje' => (float) $curso->avance_porcentaje,
                    'total_lecciones' => $totalLecciones,
                    'lecciones_completadas' => $leccionesCompletadas,
                    'estado_contratacion' => $curso->contratacion->estado_contratacion,
                ];
            }),
            'total' => $cursos->count(),
        ]);
    }

    /**
     * Obtener progreso detallado de un curso
     * GET /api/cursos/{id}/progreso
     */
    public function progreso(Request $request, string $id)
    {
        $user = $request->user();

        $curso = Curso::with(['contratacion', 'lecciones'])
            ->whereHas('contratacion', function ($q) use ($user) {
                $q->where('id_usuario', $user->id);
            })
            ->where('id', $id)
            ->first();

        if (!$curso) {
            return response()->json([
                'success' => false,
                'message' => 'Curso no encontrado',
            ], 404);
        }

        $lecciones = $curso->lecciones->sortBy('numero_leccion')->map(function ($leccion) {
            return [
                'id' => $leccion->id,
                'numero' => $leccion->numero_leccion,
                'titulo' => $leccion->titulo,
                'descripcion' => $leccion->descripcion,
                'duracion_minutos' => $leccion->duracion_minutos,
                'estado' => $leccion->estado,
                'completada' => $leccion->estado === 'completada',
                'en_progreso' => $leccion->estado === 'en_progreso',
                'bloqueada' => $leccion->estado === 'bloqueada',
            ];
        })->values();

        $totalLecciones = $lecciones->count();
        $leccionesCompletadas = $lecciones->where('completada', true)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'curso' => [
                    'id' => $curso->id,
                    'nombre' => $curso->nombre_curso,
                    'descripcion' => $curso->descripcion,
                ],
                'progreso' => [
                    'porcentaje' => (float) $curso->avance_porcentaje,
                    'total_lecciones' => $totalLecciones,
                    'completadas' => $leccionesCompletadas,
                    'restantes' => $totalLecciones - $leccionesCompletadas,
                ],
                'lecciones' => $lecciones,
            ],
        ]);
    }
}
