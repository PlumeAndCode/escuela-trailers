<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trailer;
use App\Models\RentaTrailer;
use App\Models\Contratacion;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Trailers extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $filtroEstado = '';

    // Para nueva renta
    public $showModalRenta = false;
    public $rentaTrailerId = '';
    public $rentaClienteId = '';
    public $rentaFechaInicio = '';
    public $rentaFechaDevolucion = '';

    // Para edición de renta
    public $showModalEditar = false;
    public $editingRentaId = null;
    public $editFechaDevolucion = '';
    public $editEstadoRenta = '';

    // Para marcar devolución
    public $showModalDevolucion = false;
    public $devolucionRentaId = null;
    public $devolucionFechaReal = '';

    protected $queryString = ['search', 'filtroEstado', 'perPage'];

    protected $rules = [
        'rentaTrailerId' => 'required|exists:trailers,id',
        'rentaClienteId' => 'required|exists:users,id',
        'rentaFechaInicio' => 'required|date',
        'rentaFechaDevolucion' => 'required|date|after:rentaFechaInicio',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    /**
     * Obtener tráileres disponibles (para el select de nueva renta)
     */
    public function getTrailersDisponiblesProperty()
    {
        return Trailer::where('estado_trailer', 'disponible')
            ->whereDoesntHave('rentas', function ($query) {
                $query->where('estado_renta', 'activa');
            })
            ->orderBy('modelo')
            ->get();
    }

    /**
     * Obtener clientes para el select
     */
    public function getClientesProperty()
    {
        return User::join('model_has_roles', function ($join) {
                $join->on('users.id', '=', \DB::raw('model_has_roles.model_id::uuid'));
            })
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'cliente')
            ->select('users.*')
            ->orderBy('nombre_completo')
            ->get();
    }

    /**
     * Obtener todas las rentas de tráileres
     */
    public function getRentasProperty()
    {
        $query = RentaTrailer::with([
            'trailer',
            'contratacion.usuario',
            'contratacion.servicio',
            'contratacion.pagos'
        ]);

        // Búsqueda por nombre de tráiler, placa o cliente
        if (!empty($this->search)) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('trailer', function ($trailerQuery) use ($search) {
                    $trailerQuery->where('modelo', 'ilike', "%{$search}%")
                        ->orWhere('placa', 'ilike', "%{$search}%");
                })->orWhereHas('contratacion.usuario', function ($userQuery) use ($search) {
                    $userQuery->where('nombre_completo', 'ilike', "%{$search}%");
                });
            });
        }

        // Filtro por estado de renta
        if (!empty($this->filtroEstado)) {
            $query->where('estado_renta', $this->filtroEstado);
        }

        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Abrir modal para nueva renta
     */
    public function abrirModalRenta()
    {
        $this->reset(['rentaTrailerId', 'rentaClienteId', 'rentaFechaInicio', 'rentaFechaDevolucion']);
        $this->rentaFechaInicio = now()->format('Y-m-d');
        $this->rentaFechaDevolucion = now()->addDays(7)->format('Y-m-d');
        $this->showModalRenta = true;
    }

    /**
     * Crear nueva renta
     */
    public function crearRenta()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Obtener o crear el servicio de renta de tráiler
            $servicioRenta = Servicio::where('tipo_servicio', 'renta_trailer')->first();
            
            if (!$servicioRenta) {
                $servicioRenta = Servicio::create([
                    'nombre_servicio' => 'Renta de Tráiler',
                    'tipo_servicio' => 'renta_trailer',
                    'descripcion' => 'Servicio de renta de tráiler',
                    'precio' => 0,
                    'estado_servicio' => true,
                ]);
            }

            // Crear la contratación
            $contratacion = Contratacion::create([
                'id_usuario' => $this->rentaClienteId,
                'id_servicio' => $servicioRenta->id,
                'fecha_contratacion' => now(),
                'estado_contratacion' => 'activo',
            ]);

            // Crear la renta de tráiler
            RentaTrailer::create([
                'id_trailer' => $this->rentaTrailerId,
                'id_contratacion' => $contratacion->id,
                'fecha_renta' => $this->rentaFechaInicio,
                'fecha_devolucion_estimada' => $this->rentaFechaDevolucion,
                'estado_renta' => 'activa',
            ]);

            // Actualizar estado del tráiler
            Trailer::where('id', $this->rentaTrailerId)->update(['estado_trailer' => 'rentado']);

            DB::commit();

            $this->showModalRenta = false;
            $this->reset(['rentaTrailerId', 'rentaClienteId', 'rentaFechaInicio', 'rentaFechaDevolucion']);
            session()->flash('message', 'Renta creada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al crear la renta: ' . $e->getMessage());
        }
    }

    /**
     * Abrir modal para editar renta
     */
    public function editarRenta($rentaId)
    {
        $renta = RentaTrailer::find($rentaId);
        if ($renta) {
            $this->editingRentaId = $rentaId;
            $this->editFechaDevolucion = $renta->fecha_devolucion_estimada?->format('Y-m-d');
            $this->editEstadoRenta = $renta->estado_renta;
            $this->showModalEditar = true;
        }
    }

    /**
     * Guardar cambios de renta
     */
    public function guardarCambiosRenta()
    {
        $this->validate([
            'editFechaDevolucion' => 'required|date',
            'editEstadoRenta' => 'required|in:activa,devuelta,atrasada',
        ]);

        $renta = RentaTrailer::find($this->editingRentaId);
        if ($renta) {
            $renta->update([
                'fecha_devolucion_estimada' => $this->editFechaDevolucion,
                'estado_renta' => $this->editEstadoRenta,
            ]);

            // Si se devuelve, actualizar el estado del tráiler a disponible
            if ($this->editEstadoRenta === 'devuelta') {
                $renta->trailer->update(['estado_trailer' => 'disponible']);
            }
        }

        $this->cerrarModalEditar();
        session()->flash('message', 'Renta actualizada correctamente.');
    }

    /**
     * Abrir modal para marcar devolución
     */
    public function abrirModalDevolucion($rentaId)
    {
        $this->devolucionRentaId = $rentaId;
        $this->devolucionFechaReal = now()->format('Y-m-d');
        $this->showModalDevolucion = true;
    }

    /**
     * Marcar devolución del tráiler
     */
    public function marcarDevolucion()
    {
        $this->validate([
            'devolucionFechaReal' => 'required|date',
        ]);

        $renta = RentaTrailer::find($this->devolucionRentaId);
        if ($renta) {
            $renta->update([
                'fecha_devolucion_real' => $this->devolucionFechaReal,
                'estado_renta' => 'devuelta',
            ]);

            // Actualizar estado del tráiler
            $renta->trailer->update(['estado_trailer' => 'disponible']);
        }

        $this->cerrarModalDevolucion();
        session()->flash('message', 'Devolución registrada correctamente.');
    }

    /**
     * Cerrar modales
     */
    public function cerrarModalRenta()
    {
        $this->showModalRenta = false;
        $this->reset(['rentaTrailerId', 'rentaClienteId', 'rentaFechaInicio', 'rentaFechaDevolucion']);
    }

    public function cerrarModalEditar()
    {
        $this->showModalEditar = false;
        $this->editingRentaId = null;
        $this->editFechaDevolucion = '';
        $this->editEstadoRenta = '';
    }

    public function cerrarModalDevolucion()
    {
        $this->showModalDevolucion = false;
        $this->devolucionRentaId = null;
        $this->devolucionFechaReal = '';
    }

    public function render()
    {
        $rentas = $this->rentas->paginate($this->perPage);

        return view('livewire.manager.trailers', [
            'rentas' => $rentas,
            'trailersDisponibles' => $this->trailersDisponibles,
            'clientes' => $this->clientes,
        ])->layout('layouts.manager');
    }
}