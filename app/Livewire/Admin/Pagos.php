<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Pagos extends Component
{
    use WithPagination;

    public $perPage = 25;
    public $search = '';
    public $filtroEstado = '';

    private function paginateCollection($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            array_merge($options, [
                'path' => Paginator::resolveCurrentPath(),
                'query' => Paginator::resolveQueryString(),
            ])
        );
    }

    private function getPagos()
    {
        return collect([
            (object)[
                'id_pago' => '#0001',
                'usuario' => 'Juan Pérez López',
                'servicio' => 'Curso A1 Licencia',
                'monto' => 450.00,
                'tipo_pago' => 'Tarjeta',
                'estado' => 'pagado',
                'fecha_pago' => '15/11/2024',
            ],
            (object)[
                'id_pago' => '#0002',
                'usuario' => 'María García Rodríguez',
                'servicio' => 'Curso B Transporte',
                'monto' => 650.00,
                'tipo_pago' => 'Efectivo',
                'estado' => 'pagado',
                'fecha_pago' => '14/11/2024',
            ],
            (object)[
                'id_pago' => '#0003',
                'usuario' => 'Carlos Martínez Díaz',
                'servicio' => 'Certificación Remolques',
                'monto' => 550.00,
                'tipo_pago' => 'Línea',
                'estado' => 'pendiente',
                'fecha_pago' => '20/11/2024',
            ],
            (object)[
                'id_pago' => '#0004',
                'usuario' => 'Ana López Fernández',
                'servicio' => 'Mantenimiento Preventivo',
                'monto' => 300.00,
                'tipo_pago' => 'Tarjeta',
                'estado' => 'vencido',
                'fecha_pago' => '10/11/2024',
            ],
            (object)[
                'id_pago' => '#0005',
                'usuario' => 'Roberto Sánchez Gómez',
                'servicio' => 'Capacitación Avanzada',
                'monto' => 400.00,
                'tipo_pago' => 'Efectivo',
                'estado' => 'pagado',
                'fecha_pago' => '13/11/2024',
            ],
            (object)[
                'id_pago' => '#0006',
                'usuario' => 'Laura Jiménez Ruiz',
                'servicio' => 'Curso A1 Licencia',
                'monto' => 450.00,
                'tipo_pago' => 'Tarjeta',
                'estado' => 'pendiente',
                'fecha_pago' => '25/11/2024',
            ],
            (object)[
                'id_pago' => '#0007',
                'usuario' => 'José Luis Moreno Torres',
                'servicio' => 'Curso B Transporte',
                'monto' => 650.00,
                'tipo_pago' => 'Línea',
                'estado' => 'pagado',
                'fecha_pago' => '12/11/2024',
            ],
            (object)[
                'id_pago' => '#0008',
                'usuario' => 'Elena Rodríguez Castro',
                'servicio' => 'Certificación Remolques',
                'monto' => 550.00,
                'tipo_pago' => 'Efectivo',
                'estado' => 'vencido',
                'fecha_pago' => '05/11/2024',
            ],
            (object)[
                'id_pago' => '#0009',
                'usuario' => 'Miguel Hernández López',
                'servicio' => 'Mantenimiento Preventivo',
                'monto' => 300.00,
                'tipo_pago' => 'Tarjeta',
                'estado' => 'pagado',
                'fecha_pago' => '16/11/2024',
            ],
            (object)[
                'id_pago' => '#0010',
                'usuario' => 'Patricia Gómez Velasco',
                'servicio' => 'Capacitación Avanzada',
                'monto' => 400.00,
                'tipo_pago' => 'Línea',
                'estado' => 'pendiente',
                'fecha_pago' => '22/11/2024',
            ],
            (object)[
                'id_pago' => '#0011',
                'usuario' => 'Francisco Díaz Martín',
                'servicio' => 'Curso A1 Licencia',
                'monto' => 450.00,
                'tipo_pago' => 'Efectivo',
                'estado' => 'pagado',
                'fecha_pago' => '18/11/2024',
            ],
            (object)[
                'id_pago' => '#0012',
                'usuario' => 'Mónica Fernández García',
                'servicio' => 'Curso B Transporte',
                'monto' => 650.00,
                'tipo_pago' => 'Tarjeta',
                'estado' => 'vencido',
                'fecha_pago' => '08/11/2024',
            ],
        ]);
    }

    public function render()
    {
        $pagos = $this->getPagos();

        // Filtrar por búsqueda (ID pago o usuario)
        if (!empty($this->search)) {
            $search = strtolower($this->search);
            $pagos = $pagos->filter(function ($pago) use ($search) {
                return stripos($pago->id_pago, $search) !== false ||
                       stripos($pago->usuario, $search) !== false ||
                       stripos($pago->servicio, $search) !== false;
            });
        }

        // Filtrar por estado (pagado, pendiente, vencido)
        if (!empty($this->filtroEstado)) {
            $pagos = $pagos->filter(function ($pago) {
                return $pago->estado === $this->filtroEstado;
            });
        }

        // Paginar
        $pagos = $this->paginateCollection($pagos, $this->perPage);

        return view('livewire.admin.pagos', [
            'pagos' => $pagos,
        ])->layout('layouts.admin');
    }
}