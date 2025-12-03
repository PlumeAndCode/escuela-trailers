<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contratacion;
use App\Models\Servicio;
use App\Models\Pago;
use App\Models\Curso;
use App\Models\Leccion;
use App\Models\AvanceLeccion;
use App\Models\LeccionIndividual;
use Carbon\Carbon;

class ClientServices extends Component
{
    use WithPagination;

    public $search = '';
    public $filtroEstado = '';
    public $showAddModal = false;
    public $showConfirmModal = false;
    public $servicioSeleccionado = null;
    public $contratacionACancelar = null;
    public $serviciosDisponibles = [];

    protected $listeners = ['refreshServices' => '$refresh'];

    public function mount()
    {
        $this->serviciosDisponibles = Servicio::activos()->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->servicioSeleccionado = null;
    }

    public function seleccionarServicio($servicioId)
    {
        $this->servicioSeleccionado = Servicio::find($servicioId);
    }

    public function contratar()
    {
        if (!$this->servicioSeleccionado) {
            return;
        }

        $user = auth()->user();

        // Crear la contratación
        $contratacion = Contratacion::create([
            'id_usuario' => $user->id,
            'id_servicio' => $this->servicioSeleccionado->id,
            'fecha_contratacion' => now(),
            'estado_contratacion' => 'activo',
        ]);

        // Crear pago pendiente asociado (tipo_pago se asignará cuando el cliente pague)
        Pago::create([
            'id_contratacion' => $contratacion->id,
            'fecha_pago' => now()->addDays(7),
            'monto_pagado' => $this->servicioSeleccionado->precio,
            'tipo_pago' => 'tarjeta', // Valor por defecto, se actualizará al procesar el pago
            'estado_pago' => 'pendiente',
        ]);

        // Si el servicio es de tipo 'curso', crear el curso con lecciones predeterminadas
        if ($this->servicioSeleccionado->tipo_servicio === 'curso') {
            $curso = Curso::create([
                'id_contratacion' => $contratacion->id,
                'nombre_curso' => $this->servicioSeleccionado->nombre_servicio,
                'descripcion' => $this->servicioSeleccionado->descripcion ?? 'Curso de manejo de tráileres',
                'avance_porcentaje' => 0,
            ]);

            // Crear lecciones predeterminadas para el curso
            $leccionesPredeterminadas = [
                ['nombre' => 'Introducción al manejo de tráileres', 'descripcion' => 'Conceptos básicos y seguridad vial'],
                ['nombre' => 'Conocimiento del vehículo', 'descripcion' => 'Partes del tráiler, controles y sistemas'],
                ['nombre' => 'Maniobras básicas', 'descripcion' => 'Arranque, frenado y cambio de velocidades'],
                ['nombre' => 'Maniobras en reversa', 'descripcion' => 'Técnicas de reversa y estacionamiento'],
                ['nombre' => 'Conducción en carretera', 'descripcion' => 'Manejo en diferentes tipos de vías'],
                ['nombre' => 'Conducción defensiva', 'descripcion' => 'Anticipación de riesgos y reacción segura'],
                ['nombre' => 'Práctica de examen', 'descripcion' => 'Simulación del examen práctico de licencia'],
            ];

            foreach ($leccionesPredeterminadas as $leccionData) {
                $leccion = Leccion::create([
                    'id_curso' => $curso->id,
                    'nombre_leccion' => $leccionData['nombre'],
                    'descripcion' => $leccionData['descripcion'],
                    'estado_leccion' => 'no_iniciada',
                ]);

                // Crear el avance de lección para que el encargado pueda ver y gestionar
                AvanceLeccion::create([
                    'id_leccion' => $leccion->id,
                    'id_contratacion' => $contratacion->id,
                    'estado_avance' => 'pendiente',
                ]);
            }
        }

        // Si el servicio es de tipo 'leccion', crear la lección individual
        if ($this->servicioSeleccionado->tipo_servicio === 'leccion') {
            LeccionIndividual::create([
                'id_contratacion' => $contratacion->id,
                'fecha_programada' => now()->addDays(3), // Programar para 3 días después por defecto
                'estado_leccion' => 'pendiente',
                'observaciones' => null,
            ]);
        }

        $this->closeAddModal();
        
        // Dispatch toast notification
        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Servicio contratado exitosamente'
        ]);
    }

    public function confirmarCancelacion($contratacionId)
    {
        $this->contratacionACancelar = $contratacionId;
        $this->showConfirmModal = true;
    }

    public function cancelarServicio()
    {
        if (!$this->contratacionACancelar) {
            return;
        }

        $contratacion = Contratacion::where('id', $this->contratacionACancelar)
            ->where('id_usuario', auth()->id())
            ->first();

        if ($contratacion) {
            $contratacion->update(['estado_contratacion' => 'finalizado']);
            
            $this->dispatch('toast', [
                'type' => 'success',
                'message' => 'Servicio cancelado correctamente'
            ]);
        }

        $this->showConfirmModal = false;
        $this->contratacionACancelar = null;
    }

    public function cerrarConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->contratacionACancelar = null;
    }

    public function render()
    {
        $user = auth()->user();

        $contrataciones = $user->contrataciones()
            ->with(['servicio', 'pagos' => function ($query) {
                $query->where('estado_pago', 'pendiente')->orderBy('fecha_pago', 'asc');
            }])
            ->when($this->search, function ($query) {
                $query->whereHas('servicio', function ($q) {
                    $q->where('nombre_servicio', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filtroEstado, function ($query) {
                $query->where('estado_contratacion', $this->filtroEstado);
            })
            ->orderBy('fecha_contratacion', 'desc')
            ->paginate(10);

        return view('livewire.client.client-services', [
            'contrataciones' => $contrataciones,
        ])->layout('layouts.client');
    }
}