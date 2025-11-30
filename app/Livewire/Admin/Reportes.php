<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Pago;
use App\Models\Contratacion;
use App\Models\Servicio;
use App\Models\Trailer;
use App\Models\RentaTrailer;
use App\Models\Curso;
use App\Models\AvanceLeccion;
use App\Models\TramiteLicencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Reportes extends Component
{
    public $activeTab = 'servicios';

    protected $queryString = [
        'activeTab' => ['except' => 'servicios'],
    ];

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    // Servicios más contratados
    public function getServiciosMasContratadosProperty()
    {
        return DB::table('servicios')
            ->select('servicios.id', 'servicios.nombre_servicio')
            ->selectRaw('COUNT(contrataciones.id) as total_contrataciones')
            ->leftJoin('contrataciones', 'servicios.id', '=', 'contrataciones.id_servicio')
            ->groupBy('servicios.id', 'servicios.nombre_servicio')
            ->orderByDesc('total_contrataciones')
            ->get();
    }

    // Ingresos por servicio
    public function getIngresosPorServicioProperty()
    {
        return DB::table('servicios')
            ->select('servicios.id', 'servicios.nombre_servicio')
            ->selectRaw('COALESCE(SUM(pagos.monto_pagado), 0) as total_ingresos')
            ->selectRaw('COUNT(pagos.id) as num_pagos')
            ->leftJoin('contrataciones', 'servicios.id', '=', 'contrataciones.id_servicio')
            ->leftJoin('pagos', 'contrataciones.id', '=', 'pagos.id_contratacion')
            ->groupBy('servicios.id', 'servicios.nombre_servicio')
            ->orderByDesc('total_ingresos')
            ->get();
    }

    // Clientes (usuarios con rol cliente)
    public function getClientesProperty()
    {
        return User::where('rol', 'cliente')
            ->withCount('contrataciones')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Totales para resumen
    public function getTotalesProperty()
    {
        return [
            'total_servicios' => Servicio::count(),
            'total_contrataciones' => Contratacion::count(),
            'total_ingresos' => Pago::sum('monto_pagado'),
            'total_clientes' => User::where('rol', 'cliente')->count(),
            'clientes_activos' => User::where('rol', 'cliente')->where('estado_usuario', true)->count(),
        ];
    }

    // Descargar PDF
    public function descargarPDF()
    {
        $data = [
            'titulo' => $this->getTituloPDF(),
            'fecha' => now()->format('d/m/Y H:i'),
            'activeTab' => $this->activeTab,
            'serviciosMasContratados' => $this->serviciosMasContratados,
            'ingresosPorServicio' => $this->ingresosPorServicio,
            'clientes' => $this->clientes,
            'totales' => $this->totales,
        ];

        $pdf = Pdf::loadView('pdf.reportes', $data);
        $pdf->setPaper('A4', 'landscape');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "reporte_{$this->activeTab}_" . now()->format('Y-m-d_H-i-s') . ".pdf");
    }

    protected function getTituloPDF(): string
    {
        return match($this->activeTab) {
            'servicios' => 'Servicios Más Contratados',
            'ingresos' => 'Ingresos por Servicio',
            'clientes' => 'Listado de Clientes',
            default => 'Reporte General',
        };
    }

    public function render()
    {
        return view('livewire.admin.reportes', [
            'serviciosMasContratados' => $this->serviciosMasContratados,
            'ingresosPorServicio' => $this->ingresosPorServicio,
            'clientes' => $this->clientes,
            'totales' => $this->totales,
        ])->layout('layouts.admin');
    }
}