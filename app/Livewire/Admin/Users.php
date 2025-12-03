<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 25;
    public $filtroRol = '';
    public $filtroEstado = '';

    // Para modal de edición
    public $showEditModal = false;
    public $editingUserId = null;
    public $editForm = [
        'nombre_completo' => '',
        'email' => '',
        'telefono' => '',
        'rol' => '',
        'estado_usuario' => true,
    ];

    // Para modal de creación
    public $showCreateModal = false;
    public $createForm = [
        'nombre_completo' => '',
        'email' => '',
        'telefono' => '',
        'password' => '',
        'password_confirmation' => '',
        'rol' => 'cliente',
        'estado_usuario' => true,
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 25],
        'filtroRol' => ['except' => ''],
        'filtroEstado' => ['except' => ''],
    ];

    protected $listeners = ['refreshUsers' => '$refresh'];

    protected function rules()
    {
        return [
            'editForm.nombre_completo' => 'required|string|max:255',
            'editForm.email' => 'required|email|max:255|unique:users,email,' . $this->editingUserId,
            'editForm.telefono' => 'nullable|string|max:20',
            'editForm.rol' => 'required|in:cliente,encargado,administrador',
            'editForm.estado_usuario' => 'boolean',
        ];
    }

    protected function createRules()
    {
        return [
            'createForm.nombre_completo' => 'required|string|max:255',
            'createForm.email' => 'required|email|max:255|unique:users,email',
            'createForm.telefono' => 'nullable|string|max:20',
            'createForm.password' => 'required|string|min:8|confirmed',
            'createForm.rol' => 'required|in:cliente,encargado,administrador',
            'createForm.estado_usuario' => 'boolean',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFiltroRol()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function toggleEstado(string $id): void
    {
        $user = User::find($id);
        if ($user) {
            $user->estado_usuario = !$user->estado_usuario;
            $user->save();
            $this->dispatch('refreshUsers');
        }
    }

    // Modal de Edición
    public function openEditModal(string $id): void
    {
        $user = User::find($id);
        if ($user) {
            $this->editingUserId = $id;
            $this->editForm = [
                'nombre_completo' => $user->nombre_completo,
                'email' => $user->email,
                'telefono' => $user->telefono ?? '',
                'rol' => $user->rol,
                'estado_usuario' => $user->estado_usuario,
            ];
            $this->showEditModal = true;
        }
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->editingUserId = null;
        $this->reset('editForm');
    }

    public function updateUser(): void
    {
        $this->validate($this->rules());

        $user = User::find($this->editingUserId);
        if ($user) {
            $user->update([
                'nombre_completo' => $this->editForm['nombre_completo'],
                'email' => $this->editForm['email'],
                'telefono' => $this->editForm['telefono'] ?: null,
                'rol' => $this->editForm['rol'],
                'estado_usuario' => $this->editForm['estado_usuario'],
            ]);

            // Sincronizar rol de Spatie
            $user->syncRoles([$this->editForm['rol']]);

            $this->closeEditModal();
            session()->flash('message', 'Usuario actualizado correctamente.');
        }
    }

    // Modal de Creación
    public function openCreateModal(): void
    {
        $this->reset('createForm');
        $this->createForm['rol'] = 'cliente';
        $this->createForm['estado_usuario'] = true;
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
        $this->reset('createForm');
    }

    public function createUser(): void
    {
        $this->validate($this->createRules(), [], [
            'createForm.password_confirmation' => 'confirmación de contraseña',
        ]);

        $user = User::create([
            'nombre_completo' => $this->createForm['nombre_completo'],
            'email' => $this->createForm['email'],
            'telefono' => $this->createForm['telefono'] ?: null,
            'password' => Hash::make($this->createForm['password']),
            'rol' => $this->createForm['rol'],
            'estado_usuario' => $this->createForm['estado_usuario'],
            'email_verified_at' => now(), // Usuario creado por admin ya está verificado
        ]);

        // Asignar rol de Spatie
        $user->assignRole($this->createForm['rol']);

        $this->closeCreateModal();
        session()->flash('message', 'Usuario creado correctamente.');
    }

    // Eliminar usuario
    public function deleteUser(string $id): void
    {
        $user = User::find($id);
        if ($user) {
            // No permitir eliminar al usuario autenticado
            if (auth()->id() === $id) {
                session()->flash('error', 'No puedes eliminarte a ti mismo.');
                return;
            }
            
            $user->delete();
            session()->flash('message', 'Usuario eliminado correctamente.');
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('nombre_completo', 'ilike', "%{$this->search}%")
                          ->orWhere('email', 'ilike', "%{$this->search}%")
                          ->orWhere('telefono', 'ilike', "%{$this->search}%");
                });
            })
            ->when($this->filtroRol, function ($q) {
                $q->where('rol', $this->filtroRol);
            })
            ->when($this->filtroEstado !== '', function ($q) {
                $q->where('estado_usuario', $this->filtroEstado === 'activo');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.users', [
            'users' => $users,
        ])->layout('layouts.admin');
    }
}