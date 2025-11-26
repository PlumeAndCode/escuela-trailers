<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE LECCIONES</h1>
        </div>

        <!-- Controles superiores -->
        <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Mostrar</label>
                <select wire:change="$refresh" wire:model="perPage" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20 bg-white text-gray-900 text-base font-medium">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">registros</label>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Filtro Estado:</label>
                <select wire:change="$refresh" wire:model="filtroEstado" class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium w-48">
                    <option value="">Todos</option>
                    <option value="pagada">Pagada</option>
                    <option value="no_pagada">No Pagada</option>
                    <option value="vista">Vista</option>
                    <option value="pendiente">Pendiente</option>
                </select>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Buscar:</label>
                <input wire:input="$refresh" wire:model="search" 
                    type="text" 
                    placeholder="Ingrese el nombre del usuario..." 
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
            </div>
        </div>

        <!-- Tabla de lecciones -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            @if($lecciones->isEmpty())
                <div class="p-12 text-center bg-white">
                    <p class="text-gray-500 text-base font-medium">No hay lecciones disponibles</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">ID</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre Completo</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Servicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Lección del Servicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Estado del Pago</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Estado de la Lección</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($lecciones as $index => $leccion)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $leccion->usuario_nombre ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $leccion->servicio_nombre ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $leccion->numero_leccion ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" 
                                            style="@if($leccion->estado_pago === 'pagada') background-color: #dcfce7; color: #166534; @elseif($leccion->estado_pago === 'no_pagada') background-color: #fee2e2; color: #991b1b; @else background-color: #fef3c7; color: #92400e; @endif">
                                            {{ ucfirst(str_replace('_', ' ', $leccion->estado_pago ?? 'pendiente')) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" 
                                            style="@if($leccion->estado_leccion === 'vista') background-color: #dbeafe; color: #1e40af; @elseif($leccion->estado_leccion === 'pendiente') background-color: #fed7aa; color: #92400e; @else background-color: #f3e8ff; color: #6b21a8; @endif">
                                            {{ ucfirst($leccion->estado_leccion ?? 'pendiente') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center border-r border-gray-300">
                                        <div class="flex gap-2 justify-center items-center">
                                            <button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                                style="background-color: #2563EB;"
                                                onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                                onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                                onclick="openModalEditar('{{ $leccion->id }}', '{{ $leccion->usuario_nombre ?? '' }}', '{{ $leccion->servicio_nombre ?? '' }}', '{{ $leccion->numero_leccion ?? '' }}', '{{ $leccion->estado_pago ?? '' }}', '{{ $leccion->estado_leccion ?? '' }}')">
                                                Editar
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

        @if(!$lecciones->isEmpty())
            <div class="mt-6 flex justify-center">
                {{ $lecciones->links() }}
            </div>
        @endif

        <!-- Modal para editar lección -->
        <div class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4" id="modalEditarLeccion">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Editar Lección</h2>
                        <button class="text-white text-3xl hover:text-gray-300 transition" onclick="closeModalEditar()">✕</button>
                    </div>
                </div>

                <form id="formEditar" class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Columna Izquierda -->
                        <div>
                            <div class="mb-6 pb-4 border-b border-gray-200">
                                <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Nombre del Alumno</p>
                                <p class="text-gray-900 text-lg font-bold" id="infoUsuario">Juan Pérez</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-semibold mb-2 text-xs uppercase">Número de Lección *</label>
                                <input type="text" id="editNumeroLeccion" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Estado del Pago *</label>
                                <select id="editEstadoPago" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="">Seleccione estado</option>
                                    <option value="pagada">Pagada</option>
                                    <option value="no_pagada">No Pagada</option>
                                </select>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div>
                            <div class="mb-6 pb-4 border-b border-gray-200">
                                <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Servicio</p>
                                <p class="text-gray-900 text-lg font-bold" id="infoServicio">Curso A1 Licencia</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-semibold mb-2 text-xs uppercase">Estado de la Lección *</label>
                                <select id="editEstadoLeccion" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="">Seleccione estado</option>
                                    <option value="vista">Vista</option>
                                    <option value="pendiente">Pendiente</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Nota (opcional)</label>
                                <input type="text" id="editNota" placeholder="Agregar una nota" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
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
        function openModalEditar(id, usuario, servicio, numeroLeccion, estadoPago, estadoLeccion) {
            document.getElementById('infoUsuario').textContent = usuario;
            document.getElementById('infoServicio').textContent = servicio;
            document.getElementById('editNumeroLeccion').value = numeroLeccion;
            document.getElementById('editEstadoPago').value = estadoPago;
            document.getElementById('editEstadoLeccion').value = estadoLeccion;
            document.getElementById('editNota').value = '';

            document.getElementById('modalEditarLeccion').classList.remove('hidden');
        }

        function closeModalEditar() {
            document.getElementById('modalEditarLeccion').classList.add('hidden');
        }

        document.getElementById('formEditar')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const numeroLeccion = document.getElementById('editNumeroLeccion').value;
            const estadoPago = document.getElementById('editEstadoPago').value;
            const estadoLeccion = document.getElementById('editEstadoLeccion').value;
            const nota = document.getElementById('editNota').value;

            alert('Cambios guardados exitosamente!\n\nNúmero de Lección: ' + numeroLeccion + '\nEstado del Pago: ' + estadoPago + '\nEstado de la Lección: ' + estadoLeccion + '\nNota: ' + (nota || 'Sin nota'));
            closeModalEditar();
        });

        document.getElementById('modalEditarLeccion')?.addEventListener('click', function(e) {
            if (e.target === this) closeModalEditar();
        });
    </script>
</div>