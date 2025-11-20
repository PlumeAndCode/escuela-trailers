<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE USUARIOS</h1>
        </div>

        <!-- Controles superiores -->
        <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                <select wire:model="perPage" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20 bg-white text-gray-900 text-base font-medium">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="font-semibold text-gray-900 text-base">registros:</label>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                <input wire:model.debounce.300ms="search" 
                    type="text" 
                    placeholder="Ingrese nombre o rol..." 
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
                
                <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base" 
                    style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                    onclick="openModalNuevo()">
                    + Nuevo
                </button>
            </div>
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
                                                onclick="openModalEditar('{{ $u->id }}', '{{ $u->nombre_completo ?? $u->name }}', '{{ $u->email }}', '{{ $u->telefono ?? '' }}', '{{ $u->rol ?? '' }}')">
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
        <div class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4" id="modalNuevoUsuario">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[95vh] overflow-y-auto">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <h2 class="text-3xl font-bold">Crear Nuevo Usuario</h2>
                </div>
                
                <form class="p-10 bg-white">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                        <!-- Foto -->
                        <div class="flex flex-col items-center justify-start">
                            <label class="font-bold text-gray-900 mb-4 block text-sm">Fotografía</label>
                            <div class="w-56 h-56 border-4 border-dashed border-gray-400 rounded-lg flex items-center justify-center cursor-pointer bg-gray-50 transition-all duration-300 overflow-hidden relative" 
                                id="photoUploadNuevo"
                                onmouseover="this.style.borderColor='#FF7A00'; this.style.backgroundColor='#fff7ed';"
                                onmouseout="this.style.borderColor='#d1d5db'; this.style.backgroundColor='#f9fafb';">
                                <div class="text-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-gray-600 text-sm font-medium">Subir foto</p>
                                </div>
                                <input type="file" accept="image/*" class="absolute opacity-0 w-full h-full cursor-pointer" onchange="previewPhoto(event, 'photoUploadNuevo')">
                            </div>
                        </div>

                        <!-- Campos del formulario -->
                        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Nombre Completo *</label>
                                <input type="text" placeholder="Ingrese nombre completo" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Teléfono *</label>
                                <input type="tel" placeholder="Ingrese teléfono" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="md:col-span-2 flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Correo Electrónico *</label>
                                <input type="email" placeholder="Ingrese correo electrónico" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Contraseña *</label>
                                <input type="password" placeholder="Ingrese contraseña" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Tipo de Usuario *</label>
                                <select class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="alumno">Alumno</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="encargado">Encargado</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" onclick="closeModalNuevo()">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                            style="background-color: #FF7A00;"
                            onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                            onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para editar usuario -->
        <div class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4" id="modalEditarUsuario">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[95vh] overflow-y-auto">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <h2 class="text-3xl font-bold">Editar Usuario</h2>
                </div>
                
                <form class="p-10 bg-white">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                        <!-- Foto -->
                        <div class="flex flex-col items-center justify-start">
                            <label class="font-bold text-gray-900 mb-4 block text-sm">Fotografía</label>
                            <div class="w-56 h-56 border-4 border-dashed border-gray-400 rounded-lg flex items-center justify-center cursor-pointer bg-gray-50 transition-all duration-300 overflow-hidden relative" 
                                id="photoUploadEditar"
                                onmouseover="this.style.borderColor='#FF7A00'; this.style.backgroundColor='#fff7ed';"
                                onmouseout="this.style.borderColor='#d1d5db'; this.style.backgroundColor='#f9fafb';">
                                <div class="text-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-gray-600 text-sm font-medium">Subir foto</p>
                                </div>
                                <input type="file" accept="image/*" class="absolute opacity-0 w-full h-full cursor-pointer" onchange="previewPhoto(event, 'photoUploadEditar')">
                            </div>
                        </div>

                        <!-- Campos del formulario -->
                        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Nombre Completo *</label>
                                <input type="text" id="editNombre" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Teléfono *</label>
                                <input type="tel" id="editTelefono" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="md:col-span-2 flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Correo Electrónico *</label>
                                <input type="email" id="editEmail" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Contraseña</label>
                                <input type="password" placeholder="Dejar en blanco para mantener la actual" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm">
                            </div>

                            <div class="flex flex-col">
                                <label class="font-bold text-gray-900 mb-2 text-sm">Tipo de Usuario *</label>
                                <select id="editRol" class="px-3 py-2 border-2 border-gray-300 rounded-lg text-gray-900 bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all text-sm" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="alumno">Alumno</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="encargado">Encargado</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" onclick="closeModalEditar()">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                            style="background-color: #FF7A00;"
                            onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                            onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModalNuevo() {
            document.getElementById('modalNuevoUsuario').classList.remove('hidden');
        }

        function closeModalNuevo() {
            document.getElementById('modalNuevoUsuario').classList.add('hidden');
        }

        function openModalEditar(id, nombre, email, telefono, rol) {
            document.getElementById('editNombre').value = nombre;
            document.getElementById('editEmail').value = email;
            document.getElementById('editTelefono').value = telefono;
            document.getElementById('editRol').value = rol;
            document.getElementById('modalEditarUsuario').classList.remove('hidden');
        }

        function closeModalEditar() {
            document.getElementById('modalEditarUsuario').classList.add('hidden');
        }

        function previewPhoto(event, uploadId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const photoUpload = document.getElementById(uploadId);
                    photoUpload.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/*';
                    input.className = 'absolute opacity-0 w-full h-full cursor-pointer';
                    input.onchange = function(evt) { previewPhoto(evt, uploadId); };
                    photoUpload.appendChild(input);
                }
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('modalNuevoUsuario')?.addEventListener('click', function(e) {
            if (e.target === this) closeModalNuevo();
        });

        document.getElementById('modalEditarUsuario')?.addEventListener('click', function(e) {
            if (e.target === this) closeModalEditar();
        });
    </script>
</div>