<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Curso;
use App\Models\AvanceLeccion;

class ClientProgress extends Component
{
    use WithPagination;

    public $porcentajeGeneral = 0;
    public $cursoSeleccionado = null;
    public $cursos = [];

    public function mount()
    {
        $user = auth()->user();
        $contratacionesIds = $user->contrataciones->pluck('id');

        // Obtener cursos del usuario
        $this->cursos = Curso::whereIn('id_contratacion', $contratacionesIds)
            ->with('lecciones')
            ->get();

        // Calcular progreso general
        $this->calcularProgresoGeneral();
    }

    public function calcularProgresoGeneral()
    {
        $user = auth()->user();
        $contratacionesIds = $user->contrataciones->pluck('id');

        $totalLecciones = 0;
        $leccionesCompletadas = 0;

        foreach ($this->cursos as $curso) {
            $totalLecciones += $curso->lecciones->count();
            
            foreach ($curso->lecciones as $leccion) {
                $avance = AvanceLeccion::where('id_leccion', $leccion->id)
                    ->whereIn('id_contratacion', $contratacionesIds)
                    ->first();
                
                if ($avance && in_array($avance->estado_avance, ['pagada', 'vista'])) {
                    $leccionesCompletadas++;
                }
            }
        }

        $this->porcentajeGeneral = $totalLecciones > 0 
            ? round(($leccionesCompletadas / $totalLecciones) * 100) 
            : 0;
    }

    public function filtrarPorCurso($cursoId)
    {
        $this->cursoSeleccionado = $cursoId ?: null;
        $this->resetPage();
    }

    public function getEstadoLeccion($leccionId)
    {
        $user = auth()->user();
        $contratacionesIds = $user->contrataciones->pluck('id');

        $avance = AvanceLeccion::where('id_leccion', $leccionId)
            ->whereIn('id_contratacion', $contratacionesIds)
            ->first();

        return $avance ? $avance->estado_avance : 'pendiente';
    }

    public function render()
    {
        $user = auth()->user();
        $contratacionesIds = $user->contrataciones->pluck('id');

        $cursosQuery = Curso::whereIn('id_contratacion', $contratacionesIds)
            ->with(['lecciones.avances' => function ($query) use ($contratacionesIds) {
                $query->whereIn('id_contratacion', $contratacionesIds);
            }]);

        if ($this->cursoSeleccionado) {
            $cursosQuery->where('id', $this->cursoSeleccionado);
        }

        $cursosConLecciones = $cursosQuery->get();

        // Preparar datos de lecciones con su estado
        $leccionesConEstado = [];
        foreach ($cursosConLecciones as $curso) {
            foreach ($curso->lecciones as $leccion) {
                $avance = $leccion->avances->first();
                $leccionesConEstado[] = [
                    'id' => $leccion->id,
                    'nombre' => $leccion->nombre_leccion,
                    'descripcion' => $leccion->descripcion,
                    'estado' => $avance ? $avance->estado_avance : 'pendiente',
                    'observaciones' => $leccion->observaciones,
                    'curso' => $curso->nombre_curso,
                ];
            }
        }

        // Próximas lecciones (pendientes)
        $proximasLecciones = collect($leccionesConEstado)
            ->where('estado', 'pendiente')
            ->take(3)
            ->values();

        return view('livewire.client.client-progress', [
            'leccionesConEstado' => $leccionesConEstado,
            'proximasLecciones' => $proximasLecciones,
        ])->layout('layouts.client');
    }
}