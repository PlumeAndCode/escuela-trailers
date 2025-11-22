<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Lecciones extends Component
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

    public function updatingPerPage()
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

    private function getLecciones()
    {
        return collect([
            (object)[
                'id' => 1,
                'usuario_nombre' => 'Juan Pérez',
                'servicio_nombre' => 'Manejo Básico',
                'numero_leccion' => 1,
                'estado_pago' => 'pagada',
                'estado_leccion' => 'vista',
            ],
            (object)[
                'id' => 2,
                'usuario_nombre' => 'María García',
                'servicio_nombre' => 'Manejo Avanzado',
                'numero_leccion' => 2,
                'estado_pago' => 'no_pagada',
                'estado_leccion' => 'pendiente',
            ],
            (object)[
                'id' => 3,
                'usuario_nombre' => 'Carlos López',
                'servicio_nombre' => 'Seguridad',
                'numero_leccion' => 1,
                'estado_pago' => 'pagada',
                'estado_leccion' => 'vista',
            ],
            (object)[
                'id' => 4,
                'usuario_nombre' => 'Ana Martínez',
                'servicio_nombre' => 'Manejo Básico',
                'numero_leccion' => 2,
                'estado_pago' => 'pagada',
                'estado_leccion' => 'vista',
            ],
            (object)[
                'id' => 5,
                'usuario_nombre' => 'Roberto Sánchez',
                'servicio_nombre' => 'Seguridad',
                'numero_leccion' => 2,
                'estado_pago' => 'no_pagada',
                'estado_leccion' => 'pendiente',
            ],
        ]);
    }

    public function render()
    {
        $lecciones = $this->getLecciones();

        // Filtrar por búsqueda (nombre de usuario o servicio)
        if (!empty($this->search)) {
            $search = strtolower($this->search);
            $lecciones = $lecciones->filter(function ($leccion) use ($search) {
                return stripos($leccion->usuario_nombre, $search) !== false ||
                       stripos($leccion->servicio_nombre, $search) !== false;
            });
        }

        // Filtrar por estado (estado_pago o estado_leccion)
        if (!empty($this->filtroEstado)) {
            $lecciones = $lecciones->filter(function ($leccion) {
                // Si el filtro es pagada o no_pagada, filtra por estado_pago
                if (in_array($this->filtroEstado, ['pagada', 'no_pagada'])) {
                    return $leccion->estado_pago === $this->filtroEstado;
                }
                // Si el filtro es vista o pendiente, filtra por estado_leccion
                elseif (in_array($this->filtroEstado, ['vista', 'pendiente'])) {
                    return $leccion->estado_leccion === $this->filtroEstado;
                }
                return true;
            });
        }

        // Paginar
        $lecciones = $this->paginateCollection($lecciones, $this->perPage);

        return view('livewire.manager.lecciones', [
            'lecciones' => $lecciones,
        ])->layout('layouts.manager');
    }
}