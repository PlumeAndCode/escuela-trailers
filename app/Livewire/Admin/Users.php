<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class Users extends Component
{
    public $search = '';

    public function render()
    {
        if (Schema::hasTable('users')) {
            $users = User::query()
                ->when($this->search, fn($q) => $q->where('nombre_completo', 'like', "%{$this->search}%"))
                ->paginate(10);
        } else {
            // modo demo: colección vacía
            $users = collect();
        }

        return view('livewire.admin.users', compact('users'))
            ->layout('layouts.admin');
    }
}