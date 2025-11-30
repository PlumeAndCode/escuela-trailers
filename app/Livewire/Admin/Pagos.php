<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pago;
use App\Models\Contratacion;
use App\Models\Servicio;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Pagos extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 25;
    public $filtroEstado = '';
    public $filtroTipoPago = '';
    public $filtroFechaDesde = '';
    public $filtroFechaHasta = '';

    // Modal de detalle
    public $showDetailModal = false;

    // Modal de registro de pago
    public $showRegistrarPagoModal = false;
    public $pagoForm = [
        'contratacion_id' => '',
        'monto_pagado' => '',
        'tipo_pago' => 'efectivo',
    ];

    // Modal de edición
    public $showEditModal = false;
    public $editingPagoId = null;
    public $pagoSeleccionado = null;
    public $editForm = [
        'monto_pagado' => '',
        'tipo_pago' => '',
        'estado_pago' => '',
    ];

    // Filtros para ganancias mensuales
    public $mesSeleccionado;
    public $anioSeleccionado;

    // Tab activo
    public $activeTab = 'pagos';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 25],
        'filtroEstado' => ['except' => ''],
        'filtroTipoPago' => ['except' => ''],
        'activeTab' => ['except' => 'pagos'],
    ];

    protected $listeners = ['refreshPagos' => '$refresh'];

    public function mount(): void
    {
        $this->mesSeleccionado = now()->month;
        $this->anioSeleccionado = now()->year;
    }

    protected function rules()
    {
        return [
            'pagoForm.contratacion_id' => 'required|exists:contrataciones,id',
            'pagoForm.monto_pagado' => 'required|numeric|min:0.01',
            'pagoForm.tipo_pago' => 'required|in:efectivo,tarjeta,transferencia',
        ];
    }

    protected function editRules()
    {
        return [
            'editForm.monto_pagado' => 'required|numeric|min:0.01',
            'editForm.tipo_pago' => 'required|in:efectivo,tarjeta,linea,transferencia',
            'editForm.estado_pago' => 'required|in:pendiente,pagado,vencido',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function updatingFiltroTipoPago()
    {
        $this->resetPage();
    }

    // Ver detalle del pago
    public function verDetalle(string $id): void
    {
        $this->pagoSeleccionado = Pago::with(['contratacion.usuario', 'contratacion.servicio'])
            ->find($id);
        
        if ($this->pagoSeleccionado) {
            $this->showDetailModal = true;
        }
    }

    public function closeDetailModal(): void
    {
        $this->showDetailModal = false;
        $this->pagoSeleccionado = null;
    }

    // Registrar nuevo pago
    public function openRegistrarPagoModal(): void
    {
        $this->reset('pagoForm');
        $this->pagoForm['tipo_pago'] = 'efectivo';
        $this->showRegistrarPagoModal = true;
    }

    public function closeRegistrarPagoModal(): void
    {
        $this->showRegistrarPagoModal = false;
        $this->reset('pagoForm');
    }

    public function registrarPago(): void
    {
        $this->validate($this->rules());

        $contratacion = Contratacion::find($this->pagoForm['contratacion_id']);
        
        if (!$contratacion) {
            session()->flash('error', 'Contratación no encontrada.');
            return;
        }

        Pago::create([
            'id_contratacion' => $this->pagoForm['contratacion_id'],
            'monto_pagado' => $this->pagoForm['monto_pagado'],
            'fecha_pago' => now(),
            'tipo_pago' => $this->pagoForm['tipo_pago'],
            'estado_pago' => 'pagado',
        ]);

        $this->closeRegistrarPagoModal();
        session()->flash('message', 'Pago registrado correctamente.');
    }

    // Editar pago
    public function openEditModal(string $id): void
    {
        $pago = Pago::with(['contratacion.usuario', 'contratacion.servicio'])->find($id);
        if ($pago) {
            $this->editingPagoId = $id;
            $this->pagoSeleccionado = $pago;
            $this->editForm = [
                'monto_pagado' => $pago->monto_pagado,
                'tipo_pago' => $pago->tipo_pago,
                'estado_pago' => $pago->estado_pago,
            ];
            $this->showEditModal = true;
        }
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingPagoId = null;
        $this->pagoSeleccionado = null;
        $this->reset('editForm');
    }

    public function updatePago(): void
    {
        $this->validate($this->editRules());

        $pago = Pago::find($this->editingPagoId);
        if ($pago) {
            $pago->update([
                'monto_pagado' => $this->editForm['monto_pagado'],
                'tipo_pago' => $this->editForm['tipo_pago'],
                'estado_pago' => $this->editForm['estado_pago'],
            ]);

            $this->closeEditModal();
            session()->flash('message', 'Pago actualizado correctamente.');
        }
    }

    // Marcar como pagado
    public function marcarPagado(string $id): void
    {
        $pago = Pago::find($id);
        if ($pago && $pago->estado_pago !== 'pagado') {
            $pago->update([
                'estado_pago' => 'pagado',
                'fecha_pago' => now(),
            ]);
            session()->flash('message', 'Pago marcado como pagado.');
        }
    }

    // Cancelar pago
    public function cancelarPago(string $id): void
    {
        $pago = Pago::find($id);
        if ($pago && $pago->estado_pago !== 'cancelado') {
            $pago->update([
                'estado_pago' => 'cancelado',
            ]);
            session()->flash('message', 'Pago cancelado correctamente.');
        }
    }

    // Obtener contrataciones activas para el selector
    public function getContratacionesActivasProperty()
    {
        return Contratacion::with(['usuario', 'servicio'])
            ->where('estado_contratacion', 'activo')
            ->get();
    }

    // Estadísticas de pagos
    public function getEstadisticasProperty()
    {
        return [
            'total_ingresos_mes' => Pago::where('estado_pago', 'pagado')
                ->whereMonth('fecha_pago', now()->month)
                ->whereYear('fecha_pago', now()->year)
                ->sum('monto_pagado'),
            'pagos_pendientes' => Pago::where('estado_pago', 'pendiente')->count(),
            'pagos_vencidos' => Pago::where('estado_pago', 'vencido')->count(),
            'pagos_mes' => Pago::where('estado_pago', 'pagado')
                ->whereMonth('fecha_pago', now()->month)
                ->whereYear('fecha_pago', now()->year)
                ->count(),
        ];
    }

    // Cambiar tab activo
    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    // Ganancias totales por servicio (todos los pagos registrados)
    public function getGananciasPorServicioProperty()
    {
        return DB::table('servicios')
            ->select('servicios.id', 'servicios.nombre_servicio')
            ->selectRaw('COALESCE(SUM(pagos.monto_pagado), 0) as total_ganancias')
            ->selectRaw('COUNT(pagos.id) as num_pagos')
            ->leftJoin('contrataciones', 'servicios.id', '=', 'contrataciones.id_servicio')
            ->leftJoin('pagos', 'contrataciones.id', '=', 'pagos.id_contratacion')
            ->groupBy('servicios.id', 'servicios.nombre_servicio')
            ->orderByDesc('total_ganancias')
            ->get();
    }

    // Total general de ganancias (todos los pagos)
    public function getTotalGananciasProperty()
    {
        return Pago::sum('monto_pagado');
    }

    // Ganancias por servicio en el mes seleccionado
    public function getGananciasMensualesProperty()
    {
        $mes = (int) $this->mesSeleccionado;
        $anio = (int) $this->anioSeleccionado;

        return DB::table('servicios')
            ->select('servicios.id', 'servicios.nombre_servicio')
            ->selectRaw('
                COALESCE(SUM(
                    CASE WHEN EXTRACT(MONTH FROM pagos.fecha_pago) = ? 
                        AND EXTRACT(YEAR FROM pagos.fecha_pago) = ? 
                    THEN pagos.monto_pagado ELSE 0 END
                ), 0) as total_ganancias', [$mes, $anio])
            ->selectRaw('
                COUNT(
                    CASE WHEN EXTRACT(MONTH FROM pagos.fecha_pago) = ? 
                        AND EXTRACT(YEAR FROM pagos.fecha_pago) = ? 
                    THEN pagos.id END
                ) as num_pagos', [$mes, $anio])
            ->leftJoin('contrataciones', 'servicios.id', '=', 'contrataciones.id_servicio')
            ->leftJoin('pagos', 'contrataciones.id', '=', 'pagos.id_contratacion')
            ->groupBy('servicios.id', 'servicios.nombre_servicio')
            ->orderByDesc('total_ganancias')
            ->get();
    }

    // Total de ganancias del mes seleccionado
    public function getTotalMensualProperty()
    {
        return Pago::whereMonth('fecha_pago', $this->mesSeleccionado)
            ->whereYear('fecha_pago', $this->anioSeleccionado)
            ->sum('monto_pagado');
    }

    // Años disponibles para el filtro
    public function getAniosDisponiblesProperty()
    {
        $anioMinimo = Pago::min(DB::raw('EXTRACT(YEAR FROM fecha_pago)'));
        $anioActual = now()->year;
        
        if (!$anioMinimo) {
            return [$anioActual];
        }
        
        return range((int)$anioMinimo, $anioActual);
    }

    public function render()
    {
        $pagos = Pago::with(['contratacion.usuario', 'contratacion.servicio'])
            ->when($this->search, function ($q) {
                $q->whereHas('contratacion.usuario', function ($inner) {
                    $inner->where('nombre_completo', 'ilike', "%{$this->search}%")
                          ->orWhere('email', 'ilike', "%{$this->search}%");
                });
            })
            ->when($this->filtroEstado, function ($q) {
                $q->where('estado_pago', $this->filtroEstado);
            })
            ->when($this->filtroTipoPago, function ($q) {
                $q->where('tipo_pago', $this->filtroTipoPago);
            })
            ->when($this->filtroFechaDesde, function ($q) {
                $q->whereDate('fecha_pago', '>=', $this->filtroFechaDesde);
            })
            ->when($this->filtroFechaHasta, function ($q) {
                $q->whereDate('fecha_pago', '<=', $this->filtroFechaHasta);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.pagos', [
            'pagos' => $pagos,
            'gananciasPorServicio' => $this->gananciasPorServicio,
            'totalGanancias' => $this->totalGanancias,
            'gananciasMensuales' => $this->gananciasMensuales,
            'totalMensual' => $this->totalMensual,
            'aniosDisponibles' => $this->aniosDisponibles,
        ])->layout('layouts.admin');
    }
}