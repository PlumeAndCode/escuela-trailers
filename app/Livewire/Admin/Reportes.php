<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;

class Reportes extends Component
{
    public $search = '';

    public function render()
    {
        if (Schema::hasTable('reportes')) {
            // PARA CUANDO SE TENGA LA BASE DE DATOS
            // $reportes = Reporte::query()
            //     ->when($this->search, fn($q) => $q->where('titulo', 'like', "%{$this->search}%"))
            //     ->paginate(10);
            $reportes = collect();
        } else {
            $reportes = collect();
        }

        return view('livewire.admin.reportes', compact('reportes'))
            ->layout('layouts.admin');
    }
}