<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE TRÁILERS</h1>
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
                <select wire:change="$refresh" wire:model="filtroEstado" class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium w-56">
                    <option value="">Todos</option>
                    <option value="disponible">Disponible</option>
                    <option value="rentado">Rentado</option>
                    <option value="proximo_devolucion">Próximo a Devolución</option>
                    <option value="pagado">Pagado</option>
                    <option value="no_pagado">No Pagado</option>
                </select>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Buscar:</label>
                <input wire:input="$refresh" wire:model="search" 
                    type="text" 
                    placeholder="Nombre del tráiler o cliente..." 
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
                
                <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base" 
                    style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                    onclick="openModalRentar()">
                    Rentar
                </button>
            </div>
        </div>

        <!-- Tabla de trailers -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            @if($trailers->isEmpty())
                <div class="p-12 text-center bg-white">
                    <p class="text-gray-500 text-base font-medium">No hay tráilers disponibles</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">ID</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre del Tráiler</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Estado</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre del Cliente</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Fecha de Renta</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Fecha de Devolución</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Pago</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($trailers as $index => $trailer)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $trailer->nombre_trailer ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        <span class="font-semibold rounded px-4 py-2 text-sm inline-block" 
                                            style="@if($trailer->estado === 'disponible') background-color: #dcfce7; color: #166534; @elseif($trailer->estado === 'rentado') background-color: #fef3c7; color: #92400e; @elseif($trailer->estado === 'proximo_devolucion') background-color: #fed7aa; color: #92400e; @else background-color: #f3e8ff; color: #6b21a8; @endif">
                                            {{ ucfirst(str_replace('_', ' ', $trailer->estado ?? 'N/A')) }}
                                        </span>
                                    </td>
                                    @if($trailer->estado !== 'disponible')
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $trailer->nombre_cliente ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $trailer->fecha_renta ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $trailer->fecha_devolucion ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                            <span class="font-semibold rounded px-4 py-2 text-sm inline-block" 
                                                style="@if($trailer->pago === 'pagado') background-color: #dcfce7; color: #166534; @elseif($trailer->pago === 'no_pagado') background-color: #fee2e2; color: #991b1b; @else background-color: #fef3c7; color: #92400e; @endif">
                                                {{ ucfirst(str_replace('_', ' ', $trailer->pago ?? 'pendiente')) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center border-r border-gray-300">
                                            <div class="flex gap-2 justify-center items-center">
                                                <button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                                    style="background-color: #2563EB;"
                                                    onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                                    onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                                    onclick="openModalEditar('{{ $trailer->id }}', '{{ $trailer->nombre_trailer ?? '' }}', '{{ $trailer->estado ?? '' }}', '{{ $trailer->nombre_cliente ?? '' }}', '{{ $trailer->fecha_renta ?? '' }}', '{{ $trailer->fecha_devolucion ?? '' }}', '{{ $trailer->pago ?? '' }}')">
                                                    Editar
                                                </button>
                                            </div>
                                        </td>
                                    @else
                                        <td class="px-4 py-3 text-center text-gray-400 text-sm border-r border-gray-300" colspan="4">-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if(!$trailers->isEmpty())
            <div class="mt-6 flex justify-center">
                {{ $trailers->links() }}
            </div>
        @endif

        <!-- Modal para rentar tráiler -->
        <div class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4" id="modalRentar">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Nueva Renta de Tráiler</h2>
                        <button class="text-white text-3xl hover:text-gray-300 transition" onclick="closeModalRentar()">✕</button>
                    </div>
                </div>

                <form id="formRentar" class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Columna Izquierda -->
                        <div>
                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Seleccionar Tráiler *</label>
                                <select id="rentarTrailerSelect" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="">Seleccione un tráiler</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha de Renta *</label>
                                <input type="date" id="rentarFechaRenta" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Estado del Pago *</label>
                                <select id="rentarPago" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="">Seleccione estado</option>
                                    <option value="pagado">Pagado</option>
                                    <option value="no_pagado">No Pagado</option>
                                </select>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div>
                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Nombre del Cliente *</label>
                                <input type="text" id="rentarNombreCliente" placeholder="Ingrese nombre del cliente" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha de Devolución *</label>
                                <input type="date" id="rentarFechaDevolucion" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" onclick="closeModalRentar()">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                            style="background-color: #FF7A00;"
                            onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                            onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                            Crear Renta
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para editar tráiler -->
        <div class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4" id="modalEditarTrailer">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Editar Tráiler</h2>
                        <button class="text-white text-3xl hover:text-gray-300 transition" onclick="closeModalEditar()">✕</button>
                    </div>
                </div>

                <form id="formEditar" class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Columna Izquierda -->
                        <div>
                            <div class="mb-6 pb-4 border-b border-gray-200">
                                <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Nombre del Tráiler</p>
                                <p class="text-gray-900 text-lg font-bold" id="infoNombreTrailer">Trailer 001</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-semibold mb-2 text-xs uppercase">Fecha de Renta *</label>
                                <input type="date" id="infoFechaRenta" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Estado *</label>
                                <select id="editarEstado" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="disponible">Disponible</option>
                                    <option value="rentado">Rentado</option>
                                    <option value="proximo_devolucion">Próximo a Devolución</option>
                                </select>
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div>
                            <div class="mb-6 pb-4 border-b border-gray-200">
                                <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Cliente</p>
                                <p class="text-gray-900 text-lg font-bold" id="infoNombreCliente">Juan Pérez López</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-semibold mb-2 text-xs uppercase">Fecha de Devolución *</label>
                                <input type="date" id="infoFechaDevolucion" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Estado del Pago *</label>
                                <select id="editarPago" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="pagado">Pagado</option>
                                    <option value="no_pagado">No Pagado</option>
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
        // Datos de trailers disponibles (sin rentar)
        const trailersDisponibles = [
            { id: 1, nombre: 'Trailer 001' },
            { id: 4, nombre: 'Trailer 004' },
        ];

        function openModalRentar() {
            // Llenar el select con trailers disponibles
            const select = document.getElementById('rentarTrailerSelect');
            select.innerHTML = '<option value="">Seleccione un tráiler</option>';
            
            trailersDisponibles.forEach(trailer => {
                const option = document.createElement('option');
                option.value = trailer.id;
                option.textContent = trailer.nombre;
                select.appendChild(option);
            });

            document.getElementById('modalRentar').classList.remove('hidden');
        }

        function closeModalRentar() {
            document.getElementById('modalRentar').classList.add('hidden');
        }

        function openModalEditar(id, nombreTrailer, estado, nombreCliente, fechaRenta, fechaDevolucion, pago) {
            document.getElementById('infoNombreTrailer').textContent = nombreTrailer;
            document.getElementById('infoNombreCliente').textContent = nombreCliente;
            document.getElementById('infoFechaRenta').value = fechaRenta;
            document.getElementById('infoFechaDevolucion').value = fechaDevolucion;
            
            document.getElementById('editarEstado').value = estado;
            document.getElementById('editarPago').value = pago;

            document.getElementById('modalEditarTrailer').classList.remove('hidden');
        }

        function closeModalEditar() {
            document.getElementById('modalEditarTrailer').classList.add('hidden');
        }

        document.getElementById('formRentar')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const trailer = document.getElementById('rentarTrailerSelect').value;
            const cliente = document.getElementById('rentarNombreCliente').value;
            const fechaRenta = document.getElementById('rentarFechaRenta').value;
            const fechaDevolucion = document.getElementById('rentarFechaDevolucion').value;
            const pago = document.getElementById('rentarPago').value;

            alert('Renta creada exitosamente!\n\nTráiler: ' + trailer + '\nCliente: ' + cliente + '\nFecha Renta: ' + fechaRenta + '\nFecha Devolución: ' + fechaDevolucion + '\nPago: ' + pago);
            closeModalRentar();
        });

        document.getElementById('formEditar')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const estado = document.getElementById('editarEstado').value;
            const pago = document.getElementById('editarPago').value;
            const fechaRenta = document.getElementById('infoFechaRenta').value;
            const fechaDevolucion = document.getElementById('infoFechaDevolucion').value;

            alert('Cambios guardados exitosamente!\n\nEstado: ' + estado + '\nPago: ' + pago + '\nFecha Renta: ' + fechaRenta + '\nFecha Devolución: ' + fechaDevolucion);
            closeModalEditar();
        });

        document.getElementById('modalRentar')?.addEventListener('click', function(e) {
            if (e.target === this) closeModalRentar();
        });

        document.getElementById('modalEditarTrailer')?.addEventListener('click', function(e) {
            if (e.target === this) closeModalEditar();
        });
    </script>
</div>