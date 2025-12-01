<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AvanceLeccion;
use App\Models\LeccionIndividual;
use App\Models\Pago;

class Lecciones extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $filtroEstado = '';
    public $filtroTipo = ''; // curso o individual

    // Para edición
    public $showModal = false;
    public $editingId = null;
    public $editingTipo = null; // 'avance' o 'individual'
    public $editEstadoAvance = '';
    public $editObservaciones = '';

    protected $queryString = ['search', 'filtroEstado', 'filtroTipo', 'perPage'];

    protected $rules = [
        'editEstadoAvance' => 'required|in:pendiente,en_progreso,vista,pagada',
        'editObservaciones' => 'nullable|string|max:500',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function updatingFiltroTipo()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    /**
     * Obtener lecciones de avance de cursos
     */
    public function getAvancesLeccionesProperty()
    {
        $query = AvanceLeccion::with([
            'leccion.curso.contratacion.usuario',
            'leccion.curso.contratacion.servicio',
            'contratacion.usuario',
            'contratacion.servicio',
            'contratacion.pagos'
        ]);

        // Búsqueda por nombre de usuario o servicio
        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('contratacion.usuario', function ($userQuery) use ($search) {
                    $userQuery->where('nombre_completo', 'ilike', "%{$search}%");
                })->orWhereHas('contratacion.servicio', function ($serviceQuery) use ($search) {
                    $serviceQuery->where('nombre_servicio', 'ilike', "%{$search}%");
                })->orWhereHas('leccion', function ($leccionQuery) use ($search) {
                    $leccionQuery->where('nombre_leccion', 'ilike', "%{$search}%");
                });
            });
        }

        // Filtro por estado de avance
        if (!empty($this->filtroEstado)) {
            $query->where('estado_avance', $this->filtroEstado);
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Obtener lecciones individuales
     */
    public function getLeccionesIndividualesProperty()
    {
        $query = LeccionIndividual::with([
            'contratacion.usuario',
            'contratacion.servicio',
            'contratacion.pagos'
        ]);

        // Búsqueda por nombre de usuario o servicio
        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('contratacion.usuario', function ($userQuery) use ($search) {
                    $userQuery->where('nombre_completo', 'ilike', "%{$search}%");
                })->orWhereHas('contratacion.servicio', function ($serviceQuery) use ($search) {
                    $serviceQuery->where('nombre_servicio', 'ilike', "%{$search}%");
                });
            });
        }

        // Filtro por estado de lección
        if (!empty($this->filtroEstado)) {
            $query->where('estado_leccion', $this->filtroEstado);
        }

        return $query->orderBy('fecha_programada', 'desc');
    }

    /**
     * Abrir modal para editar
     */
    public function editarLeccion($id, $tipo)
    {
        $this->editingId = $id;
        $this->editingTipo = $tipo;

        if ($tipo === 'avance') {
            $avance = AvanceLeccion::find($id);
            if ($avance) {
                $this->editEstadoAvance = $avance->estado_avance;
                $this->editObservaciones = $avance->leccion?->observaciones ?? '';
            }
        } else {
            $leccion = LeccionIndividual::find($id);
            if ($leccion) {
                $this->editEstadoAvance = $leccion->estado_leccion;
                $this->editObservaciones = $leccion->observaciones ?? '';
            }
        }

        $this->showModal = true;
    }

    /**
     * Guardar cambios
     */
    public function guardarCambios()
    {
        $this->validate();

        if ($this->editingTipo === 'avance') {
            $avance = AvanceLeccion::find($this->editingId);
            if ($avance) {
                $avance->update(['estado_avance' => $this->editEstadoAvance]);
                
                // Actualizar observaciones en la lección si existe
                if ($avance->leccion) {
                    $avance->leccion->update(['observaciones' => $this->editObservaciones]);
                }
            }
        } else {
            $leccion = LeccionIndividual::find($this->editingId);
            if ($leccion) {
                $leccion->update([
                    'estado_leccion' => $this->editEstadoAvance,
                    'observaciones' => $this->editObservaciones,
                ]);
            }
        }

        $this->cerrarModal();
        session()->flash('message', 'Lección actualizada correctamente.');
    }

    /**
     * Cerrar modal
     */
    public function cerrarModal()
    {
        $this->showModal = false;
        $this->editingId = null;
        $this->editingTipo = null;
        $this->editEstadoAvance = '';
        $this->editObservaciones = '';
    }

    /**
     * Determinar estado de pago de una contratación
     */
    private function getEstadoPago($contratacion): string
    {
        if (!$contratacion) return 'pendiente';
        
        $pagos = $contratacion->pagos;
        if ($pagos->isEmpty()) return 'pendiente';
        
        $pagado = $pagos->where('estado_pago', 'pagado')->sum('monto_pagado');
        $total = $contratacion->servicio?->precio ?? 0;
        
        if ($pagado >= $total) return 'pagado';
        if ($pagado > 0) return 'parcial';
        return 'pendiente';
    }

    public function render()
    {
        // Determinar qué datos mostrar según el filtro de tipo
        if ($this->filtroTipo === 'curso') {
            $lecciones = $this->avancesLecciones->paginate($this->perPage);
            $tipoActual = 'avance';
        } elseif ($this->filtroTipo === 'individual') {
            $lecciones = $this->leccionesIndividuales->paginate($this->perPage);
            $tipoActual = 'individual';
        } else {
            // Mostrar avances de lecciones por defecto (más común)
            $lecciones = $this->avancesLecciones->paginate($this->perPage);
            $tipoActual = 'avance';
        }

        return view('livewire.manager.lecciones', [
            'lecciones' => $lecciones,
            'tipoActual' => $tipoActual,
        ])->layout('layouts.manager');
    }
}