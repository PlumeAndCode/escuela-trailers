<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="py-2 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE PAGOS</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button wire:click="setActiveTab('pagos')" 
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300"
                style="background-color: {{ $activeTab === 'pagos' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'pagos' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'pagos' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};">
                Todos los Pagos
            </button>
            <button wire:click="setActiveTab('ganancias')" 
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300"
                style="background-color: {{ $activeTab === 'ganancias' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'ganancias' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'ganancias' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};">
                Ganancias por Servicio
            </button>
            <button wire:click="setActiveTab('mensual')" 
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300"
                style="background-color: {{ $activeTab === 'mensual' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'mensual' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'mensual' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};">
                Ganancias Mensuales
            </button>
        </div>

        <!-- TAB: Todos los Pagos -->
        <div style="display: {{ $activeTab === 'pagos' ? 'block' : 'none' }};">
            <!-- Controles superiores -->
            <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-2">
                    <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                    <select wire:change="$refresh" wire:model="perPage" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20 bg-white text-gray-900 text-base font-medium">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="font-semibold text-gray-900 text-base">registros:</label>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Filtrar Estado:</label>
                    <select wire:change="$refresh" wire:model="filtroEstado" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium">
                        <option value="">Todos</option>
                        <option value="pagado">Pagados</option>
                        <option value="pendiente">Pendientes</option>
                        <option value="vencido">Vencidos</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                    <input wire:input="$refresh" wire:model="search" 
                        type="text" 
                        placeholder="Buscar por ID o usuario..." 
                        class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
                </div>
            </div>

            <!-- Tabla de pagos -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                @if($pagos->isEmpty())
                    <div class="p-12 text-center bg-white">
                        <p class="text-gray-500 text-base font-medium">No hay pagos disponibles</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">#</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Usuario</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Servicio</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Monto</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Tipo Pago</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Estado</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Fecha Pago</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($pagos as $index => $pago)
                                    <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $pagos->firstItem() + $index }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $pago->contratacion?->usuario?->nombre_completo ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $pago->contratacion?->servicio?->nombre_servicio ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">${{ number_format($pago->monto_pagado ?? 0, 2) }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ ucfirst($pago->tipo_pago ?? 'N/A') }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">
                                            <span class="font-semibold rounded px-4 py-2 text-sm inline-block" 
                                                style="@if($pago->estado_pago === 'pagado') background-color: #10b981; color: #ffffff; @elseif($pago->estado_pago === 'pendiente') background-color: #f59e0b; color: #ffffff; @elseif($pago->estado_pago === 'vencido') background-color: #ef4444; color: #ffffff; @endif">
                                                {{ ucfirst($pago->estado_pago ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $pago->fecha_pago ? \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') : 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                                style="background-color: #2563EB;"
                                                onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                                onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                                wire:click="openEditModal('{{ $pago->id }}')">
                                                Editar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            @if(!$pagos->isEmpty())
                <div class="mt-6 flex justify-center">
                    {{ $pagos->links() }}
                </div>
            @endif
        </div>

        <!-- TAB: Ganancias por Servicio -->
        <div style="display: {{ $activeTab === 'ganancias' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Ganancias Totales por Servicio</h2>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Servicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Ganancias Totales</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase">Número de Pagos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($gananciasPorServicio as $servicio)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $servicio->nombre_servicio }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">${{ number_format($servicio->total_ganancias, 2) }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">{{ $servicio->num_pagos }}</td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="3" class="px-4 py-8 text-center text-gray-500">No hay servicios registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 p-6 bg-gradient-to-r from-gray-200 to-gray-300 rounded-lg text-right">
                <p class="text-gray-600 text-sm font-medium mb-2">Total de Ganancias</p>
                <p class="text-4xl font-bold text-gray-900">${{ number_format($totalGanancias, 2) }}</p>
            </div>
        </div>

        <!-- TAB: Ganancias Mensuales -->
        <div style="display: {{ $activeTab === 'mensual' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Ganancias Mensuales</h2>

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <!-- Selector de Meses -->
                    <div class="flex items-center gap-4">
                        <label class="font-bold text-gray-900 text-base whitespace-nowrap">Mes:</label>
                        <select wire:model.live="mesSeleccionado" class="border-2 border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium flex-1">
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>

                    <!-- Selector de Año -->
                    <div class="flex items-center gap-4">
                        <label class="font-bold text-gray-900 text-base whitespace-nowrap">Año:</label>
                        <select wire:model.live="anioSeleccionado" class="border-2 border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium flex-1">
                            @foreach($aniosDisponibles as $anio)
                                <option value="{{ $anio }}">{{ $anio }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Total del Mes -->
                    <div class="flex items-center gap-3 bg-gradient-to-r from-orange-100 to-orange-50 rounded-lg border-2 border-orange-300 px-6 py-3">
                        <p class="text-gray-900 font-bold text-base whitespace-nowrap">Total del Mes:</p>
                        <p class="text-gray-900 font-bold text-xl">${{ number_format($totalMensual, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Servicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Ganancias del Mes</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase">Número de Pagos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($gananciasMensuales as $servicio)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $servicio->nombre_servicio }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">${{ number_format($servicio->total_ganancias, 2) }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">{{ $servicio->num_pagos }}</td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="3" class="px-4 py-8 text-center text-gray-500">No hay pagos registrados en este mes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar pago -->
    @if($showEditModal && $pagoSeleccionado)
    <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto" @click.away="$wire.closeEditModal()">
            <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Editar Pago</h2>
                    <button class="text-white text-3xl hover:text-gray-300 transition" wire:click="closeEditModal">✕</button>
                </div>
            </div>

            <form wire:submit.prevent="updatePago" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Columna Izquierda -->
                    <div>
                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Registro</p>
                            <p class="text-gray-900 text-lg font-bold">Pago seleccionado</p>
                        </div>

                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Usuario</p>
                            <p class="text-gray-900 text-lg font-bold">{{ $pagoSeleccionado->contratacion?->usuario?->nombre_completo ?? 'N/A' }}</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Tipo de Pago</label>
                            <select wire:model="editForm.tipo_pago" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="linea">Línea</option>
                            </select>
                            @error('editForm.tipo_pago') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div>
                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Servicio</p>
                            <p class="text-gray-900 text-lg font-bold">{{ $pagoSeleccionado->contratacion?->servicio?->nombre_servicio ?? 'N/A' }}</p>
                        </div>

                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Monto</p>
                            <p class="text-gray-900 text-lg font-bold">${{ number_format($pagoSeleccionado->monto_pagado ?? 0, 2) }}</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Estado del Pago</label>
                            <select wire:model="editForm.estado_pago" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
                                <option value="pagado">Pagado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="vencido">Vencido</option>
                            </select>
                            @error('editForm.estado_pago') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
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