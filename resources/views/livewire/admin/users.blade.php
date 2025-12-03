<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE USUARIOS</h1>
        </div>

        <!-- Controles superiores -->
        <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                <select wire:change="$refresh" wire:model="perPage" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20 bg-white text-gray-900 text-base font-medium">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="font-semibold text-gray-900 text-base">registros:</label>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                <input wire:input="$refresh" wire:model="search" 
                    type="text" 
                    placeholder="Buscar por nombre, email o teléfono..." 
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
                
                <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base" 
                    style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                    wire:click="openCreateModal">
                    + Nuevo
                </button>
            </div>
        </div>

        <!-- Filtros por rol -->
        <div class="flex justify-center gap-3 mb-6 flex-wrap">
            <button wire:click="$set('filtroRol', '')" 
                class="font-bold rounded-lg px-5 py-2 transition-all duration-300 text-sm"
                style="background-color: {{ $filtroRol === '' ? '#FF7A00' : '#ffffff' }}; color: {{ $filtroRol === '' ? '#ffffff' : '#374151' }}; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                onmouseover="this.style.transform='translateY(-2px)';"
                onmouseout="this.style.transform='translateY(0)';">
                Todos
            </button>
            <button wire:click="$set('filtroRol', 'cliente')" 
                class="font-bold rounded-lg px-5 py-2 transition-all duration-300 text-sm"
                style="background-color: {{ $filtroRol === 'cliente' ? '#FF7A00' : '#ffffff' }}; color: {{ $filtroRol === 'cliente' ? '#ffffff' : '#374151' }}; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                onmouseover="this.style.transform='translateY(-2px)';"
                onmouseout="this.style.transform='translateY(0)';">
                Clientes
            </button>
            <button wire:click="$set('filtroRol', 'encargado')" 
                class="font-bold rounded-lg px-5 py-2 transition-all duration-300 text-sm"
                style="background-color: {{ $filtroRol === 'encargado' ? '#FF7A00' : '#ffffff' }}; color: {{ $filtroRol === 'encargado' ? '#ffffff' : '#374151' }}; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                onmouseover="this.style.transform='translateY(-2px)';"
                onmouseout="this.style.transform='translateY(0)';">
                Encargados
            </button>
            <button wire:click="$set('filtroRol', 'administrador')" 
                class="font-bold rounded-lg px-5 py-2 transition-all duration-300 text-sm"
                style="background-color: {{ $filtroRol === 'administrador' ? '#FF7A00' : '#ffffff' }}; color: {{ $filtroRol === 'administrador' ? '#ffffff' : '#374151' }}; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                onmouseover="this.style.transform='translateY(-2px)';"
                onmouseout="this.style.transform='translateY(0)';">
                Administradores
            </button>
        </div>

        <!-- Tabla de usuarios -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            @if($users->isEmpty())
                <div class="p-12 text-center bg-white">
                    <p class="text-gray-500 text-base font-medium">No hay usuarios disponibles</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">ID</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre Completo</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Email</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Tipo de Usuario</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($users as $index => $u)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $u->nombre_completo ?? $u->name }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $u->email }}</td>
                                    <td class="px-4 py-3 text-center text-gray-700 text-base border-r border-gray-300">{{ ucfirst($u->rol ?? '-') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex gap-2 justify-center items-center">
                                            <button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                                style="background-color: #2563EB;"
                                                onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                                onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                                wire:click="openEditModal('{{ $u->id }}')">
                                                Editar
                                            </button>
                                            <button
                                                class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300"
                                                style="{{ $u->estado_usuario ? 'background-color: #16A34A;' : 'background-color: #DC2626;' }}"
                                                onmouseover="this.style.boxShadow='0 0 20px ' + (this.style.backgroundColor.includes('22') ? 'rgba(22, 163, 74, 0.8)' : 'rgba(220, 38, 38, 0.8)'); this.style.transform='translateY(-2px) scale(1.05)';"
                                                onmouseout="this.style.boxShadow='0 0 10px ' + (this.style.backgroundColor.includes('22') ? 'rgba(22, 163, 74, 0.4)' : 'rgba(220, 38, 38, 0.4)'); this.style.transform='translateY(0) scale(1)';"
                                                wire:click="toggleEstado('{{ $u->id }}')"
                                            >
                                                {{ $u->estado_usuario ? 'Activo' : 'Inactivo' }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if(!$users->isEmpty())
            <div class="mt-6 flex justify-center">
                {{ $users->links() }}
            </div>
        @endif

        <!-- Modal para crear nuevo usuario -->
        @if($showCreateModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[95vh] overflow-y-auto" @click.away="$wire.closeCreateModal()">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold">Crear Nuevo Usuario</h2>
                        <button class="text-white text-3xl hover:text-gray-300 transition" wire:click="closeCreateModal">✕</button>
                    </div>
                </div>
                
                <form wire:submit.prevent="createUser" class="p-10 bg-white">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                        <!-- Foto -->
                        <div class="flex flex-col items-center justify-start">
                            <label class="font-bold text-gray-900 mb-4 block text-sm">Fotografía</label>
                            <div class="w-56 h-56 border-4 border-dashed border-gray-400 rounded-lg flex items-center justify-center cursor-pointer bg-gray-50 transition-all duration-300 overflow-hidden relative">
                                <div class="text-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-gray-600 text-sm font-medium">Subir foto</p>
                                </div>
                            </div>
                        </div>

                        <!-- Campos del formulario -->
                        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Nombre Completo *</label>
                                <input type="text" wire:model="createForm.nombre_completo" placeholder="Ingrese nombre completo" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                @error('createForm.nombre_completo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Teléfono</label>
                                <input type="tel" wire:model="createForm.telefono" placeholder="Ingrese teléfono" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                @error('createForm.telefono') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2 flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Correo Electrónico *</label>
                                <input type="email" wire:model="createForm.email" placeholder="Ingrese correo electrónico" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                @error('createForm.email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col" x-data="{ showPassword: false }">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Contraseña *</label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" wire:model="createForm.password" placeholder="Ingrese contraseña" class="w-full px-3 py-2 pr-10 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                                @error('createForm.password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col" x-data="{ showPassword: false }">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Confirmar Contraseña *</label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" wire:model="createForm.password_confirmation" placeholder="Confirme contraseña" class="w-full px-3 py-2 pr-10 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
                                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Tipo de Usuario *</label>
                                <select wire:model="createForm.rol" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="encargado">Encargado</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                                @error('createForm.rol') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Estado</label>
                                <select wire:model="createForm.estado_usuario" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" wire:click="closeCreateModal">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                            style="background-color: #FF7A00;">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Modal para editar usuario -->
        @if($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[95vh] overflow-y-auto" @click.away="$wire.closeEditModal()">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-bold">Editar Usuario</h2>
                        <button class="text-white text-3xl hover:text-gray-300 transition" wire:click="closeEditModal">✕</button>
                    </div>
                </div>
                
                <form wire:submit.prevent="updateUser" class="p-10 bg-white">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                        <!-- Foto -->
                        <div class="flex flex-col items-center justify-start">
                            <label class="font-bold text-gray-900 mb-4 block text-sm">Fotografía</label>
                            <div class="w-56 h-56 border-4 border-dashed border-gray-400 rounded-lg flex items-center justify-center cursor-pointer bg-gray-50 transition-all duration-300 overflow-hidden relative">
                                <div class="text-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-gray-600 text-sm font-medium">Subir foto</p>
                                </div>
                            </div>
                        </div>

                        <!-- Campos del formulario -->
                        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Nombre Completo *</label>
                                <input type="text" wire:model="editForm.nombre_completo" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                @error('editForm.nombre_completo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Teléfono</label>
                                <input type="tel" wire:model="editForm.telefono" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                @error('editForm.telefono') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2 flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Correo Electrónico *</label>
                                <input type="email" wire:model="editForm.email" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                @error('editForm.email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Tipo de Usuario *</label>
                                <select wire:model="editForm.rol" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="encargado">Encargado</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                                @error('editForm.rol') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Estado</label>
                                <select wire:model="editForm.estado_usuario" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" wire:click="closeEditModal">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                            style="background-color: #FF7A00;">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Mensaje de éxito/error -->
        @if (session()->has('message'))
            <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>