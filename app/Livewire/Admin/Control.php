<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;

class Control extends Component
{
    public $search = '';

    public function render()
    {
        if (Schema::hasTable('controles')) {
            // PARA CUANDO SE TENGA LA BASE DE DATOS
            // $controles = Control::query()
            //     ->when($this->search, fn($q) => $q->where('nombre', 'like', "%{$this->search}%"))
            //     ->paginate(10);
            $controles = collect();
        } else {
            $controles = collect();
        }

        return view('livewire.admin.control', compact('controles'))
            ->layout('layouts.admin');
    }
}