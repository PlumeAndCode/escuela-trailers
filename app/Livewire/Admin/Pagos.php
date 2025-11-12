<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;

class Pagos extends Component
{
    public $search = '';

    public function render()
    {
        if (Schema::hasTable('pagos')) {
            // PARA CUANDO SE TENGA LA BASE DE DATOS
            // $pagos = Pago::query()
            //     ->when($this->search, fn($q) => $q->where('numero_transaccion', 'like', "%{$this->search}%"))
            //     ->paginate(10);
            $pagos = collect();
        } else {
            $pagos = collect();
        }

        return view('livewire.admin.pagos', compact('pagos'))
            ->layout('layouts.admin');
    }
}