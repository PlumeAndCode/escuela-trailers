<style>
    thead.header-users {
        background-color: #1b3346 !important; 
        color: white !important;
    }

    table.users-table {
        border-collapse: collapse;
        width: 100%;
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid #e5e7eb; 
    }

    table.users-table th,
    table.users-table td {
        padding: 12px;
        text-align: center; 
        border-right: 1px solid #e5e7eb; 
    }

    table.users-table th:last-child,
    table.users-table td:last-child {
        border-right: none;
    }

    table.users-table tbody tr {
        border-bottom: 1px solid #e5e7eb; 
    }

    table.users-table tbody tr:hover {
        background-color: #f9fafb;
        transition: background-color 0.2s ease;
    }

    .btn {
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 8px 16px;
        color: white;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: none;
    }

    .btn-edit {
        background-color: #FF7A00;
    }
    .btn-edit:hover {
        box-shadow: 0 0 15px rgba(255, 122, 0, 0.5);
        transform: scale(1.03);
    }

    .btn-active {
        background-color: #16A34A;
    }
    .btn-active:hover {
        box-shadow: 0 0 15px rgba(22, 163, 74, 0.5);
        transform: scale(1.03);
    }

    .btn-inactive {
        background-color: #DC2626;
    }
    .btn-inactive:hover {
        box-shadow: 0 0 15px rgba(220, 38, 38, 0.5);
        transform: scale(1.03);
    }

    .actions-cell {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .table-container {
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .pagination-wrapper {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        padding-bottom: 1rem;
    }
</style>

<div class="p-6">
    <h1 class="text-3xl font-bold text-center mb-6">GESTIÓN DE USUARIOS</h1>

    <!-- Controles superiores -->
    <div class="flex justify-between items-center mb-6 gap-4">
        <div class="flex items-center gap-2">
            <label class="font-semibold">Mostrar</label>
            <select class="border rounded px-4 py-1 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20">
                <option value="10">10</option>
                <option value="25" selected>25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <label class="font-semibold">registros:</label>
        </div>

        <div class="flex items-center gap-3">
            <label class="font-semibold whitespace-nowrap">Buscar:</label>
            <input wire:model.debounce.300ms="search" 
                type="text" 
                placeholder="Ingrese nombre o rol..." 
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 w-70">
            
            <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/50">
                Nuevo
            </button>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="table-container">
        @if($users->isEmpty())
            <div class="p-6 text-center text-gray-600">
                <p class="mb-2">No hay usuarios registrados.</p>
                <p class="text-sm">
                    Cuando conectes la base de datos y migres la tabla 
                    <code class="bg-gray-100 px-2 py-1 rounded">users</code>,
                    verás la lista aquí.
                </p>
            </div>
        @else
            <table class="users-table">
                <thead class="header-users">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Tipo de Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $u)
                        <tr>
                            <td>{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $u->nombre_completo ?? $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->rol ?? '-' }}</td>
                            <td class="actions-cell">
                                <button class="btn btn-edit">Editar</button>
                                @if($u->activo)
                                    <button class="btn btn-active">Activo</button>
                                @else
                                    <button class="btn btn-inactive">Inactivo</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    @if(!$users->isEmpty())
        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    @endif
</div>
