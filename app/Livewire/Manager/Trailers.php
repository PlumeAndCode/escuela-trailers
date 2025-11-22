<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Trailers extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $filtroEstado = '';

    protected $queryString = ['search', 'filtroEstado', 'perPage'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

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

    public function render()
    {
        // Datos de ejemplo - Reemplaza con tu lógica real de BD
        $trailers = collect([
            (object)[
                'id' => 1,
                'nombre_trailer' => 'Trailer 001',
                'estado' => 'disponible',
                'nombre_cliente' => 'Juan Pérez',
                'fecha_renta' => '2025-11-15',
                'fecha_devolucion' => '2025-11-22',
                'pago' => 'pagado',
            ],
            (object)[
                'id' => 2,
                'nombre_trailer' => 'Trailer 002',
                'estado' => 'rentado',
                'nombre_cliente' => 'María García',
                'fecha_renta' => '2025-11-10',
                'fecha_devolucion' => '2025-11-25',
                'pago' => 'no_pagado',
            ],
            (object)[
                'id' => 3,
                'nombre_trailer' => 'Trailer 003',
                'estado' => 'proximo_devolucion',
                'nombre_cliente' => 'Carlos López',
                'fecha_renta' => '2025-10-28',
                'fecha_devolucion' => '2025-11-21',
                'pago' => 'pagado',
            ],
            (object)[
                'id' => 4,
                'nombre_trailer' => 'Trailer 004',
                'estado' => 'disponible',
                'nombre_cliente' => 'Ana Martínez',
                'fecha_renta' => '2025-11-18',
                'fecha_devolucion' => '2025-11-30',
                'pago' => 'pagado',
            ],
            (object)[
                'id' => 5,
                'nombre_trailer' => 'Trailer 005',
                'estado' => 'rentado',
                'nombre_cliente' => 'Roberto Sánchez',
                'fecha_renta' => '2025-11-08',
                'fecha_devolucion' => '2025-11-23',
                'pago' => 'no_pagado',
            ],
        ]);

        // Filtrar por búsqueda (nombre trailer o cliente)
        if ($this->search) {
            $trailers = $trailers->filter(function ($trailer) {
                return stripos($trailer->nombre_trailer, $this->search) !== false || 
                       stripos($trailer->nombre_cliente, $this->search) !== false;
            });
        }

        // Filtrar por estado
        if ($this->filtroEstado) {
            $trailers = $trailers->filter(function ($trailer) {
                return $trailer->estado === $this->filtroEstado || $trailer->pago === $this->filtroEstado;
            });
        }

        // Paginar usando el método personalizado
        $trailers = $this->paginateCollection($trailers, $this->perPage);

        return view('livewire.manager.trailers', [
            'trailers' => $trailers,
        ])->layout('layouts.manager');
    }
}