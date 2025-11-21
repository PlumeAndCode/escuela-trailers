<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 25;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 25],
    ];

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function toggleEstado(string $id): void
    {
        $user = User::find($id);
        if ($user) {
            $user->estado_usuario = ! $user->estado_usuario;
            $user->save();
            $this->dispatch('refreshUsers');
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('nombre_completo', 'ilike', "%{$this->search}%")
                          ->orWhere('email', 'ilike', "%{$this->search}%")
                          ->orWhere('rol', 'ilike', "%{$this->search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.users', [
            'users' => $users,
        ])->layout('layouts.admin');
    }
}