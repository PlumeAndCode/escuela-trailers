<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $user;

    public function mount()
    {
        // PORQUE NO HAY BASE DE DATOS AUN
        $this->user = Auth::user() ?: (object)[
            'nombre_completo' => 'Administrador Demo',
            'email' => 'admin@demo.local',
            'profile_photo_url' => asset('images/default-avatar.png'),
            'rol' => 'administrador',
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard', ['user' => $this->user])
            ->layout('layouts.admin');
    }
}