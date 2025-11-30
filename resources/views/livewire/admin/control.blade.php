<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE CONTROL</h1>
        </div>

        <!-- Botones de sección -->
<div class="flex justify-center gap-4 mb-6 flex-wrap">
    <button wire:click="switchTab('avance')" class="text-white font-bold rounded-lg px-6 py-3 transition-all duration-300" 
        style="background-color: {{ $activeTab === 'avance' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'avance' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'avance' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};"
        onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.boxShadow='{{ $activeTab === 'avance' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }}'; this.style.transform='translateY(0)';">
        Avance Alumno
    </button>
    <button wire:click="switchTab('trailers')" class="text-gray-900 font-bold rounded-lg px-6 py-3 transition-all duration-300" 
        style="background-color: {{ $activeTab === 'trailers' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'trailers' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'trailers' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};"
        onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.boxShadow='{{ $activeTab === 'trailers' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }}'; this.style.transform='translateY(0)';">
        Visualización Trailers
    </button>
    <button wire:click="switchTab('reportes')" class="text-gray-900 font-bold rounded-lg px-6 py-3 transition-all duration-300" 
        style="background-color: {{ $activeTab === 'reportes' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'reportes' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'reportes' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};"
        onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
        onmouseout="this.style.boxShadow='{{ $activeTab === 'reportes' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }}'; this.style.transform='translateY(0)';">
        Reportes Trailers
    </button>
</div>

        <!-- TAB: Avance Alumno -->
<div id="section-avance" style="display: {{ $activeTab === 'avance' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Avance del Alumno</h2>

            <!-- Controles superiores -->
            <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-2">
                    <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                    <select wire:change="$refresh" wire:model="perPageAvance" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="font-semibold text-gray-900 text-base">registros:</label>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Filtrar Curso:</label>
                    <select wire:change="$refresh" wire:model="filtroCursoAvance" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900 text-base font-medium">
                        <option value="">Todos los Cursos</option>
                        <option value="conduccion">Curso de Conducción A</option>
                        <option value="seguridad">Seguridad Vial</option>
                        <option value="remolques">Manejo de Remolques</option>
                        <option value="señalamientos">Señalamientos y Normativas</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                    <input wire:input="$refresh" wire:model="searchAvance" 
                        type="text" 
                        placeholder="Buscar por ID o nombre..." 
                        class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900 placeholder-gray-400 text-base w-64">
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Curso</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Lecciones del Curso</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Lecciones Tomadas</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">% Completado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($avances as $index => $avance)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $avances->firstItem() + $index }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $avance->nombre }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $avance->curso }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $avance->lecciones_total }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $avance->lecciones_completadas }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">
                                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-2">
                                            <div class="h-3 rounded-full transition-all duration-300" style="width: {{ $avance->porcentaje }}%; background-color: #10b981;"></div>
                                        </div>
                                        <span class="font-bold text-gray-900 text-sm">{{ $avance->porcentaje }}%</span>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay datos disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(!$avances->isEmpty())
                <div class="mt-6 flex justify-center">
                    {{ $avances->links() }}
                </div>
            @endif
        </div>

        <!-- TAB: Visualización Trailers -->
<div id="section-trailers" style="display: {{ $activeTab === 'trailers' ? 'block' : 'none' }};">
            
            <!-- Trailers Disponibles -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Trailers Disponibles</h2>
                
                <!-- Controles superiores -->
                <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center gap-2">
                        <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                        <select wire:change="$refresh" wire:model="perPageTrailersDisp" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label class="font-semibold text-gray-900 text-base">registros:</label>
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                        <input wire:input="$refresh" wire:model="searchTrailersDisp" 
                            type="text" 
                            placeholder="Buscar por ID o placa..." 
                            class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900 placeholder-gray-400 text-base w-64">
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 max-h-96 overflow-y-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Modelo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Número de Serie</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase sticky top-0">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($trailersDisponibles as $index => $trailer)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailersDisponibles->firstItem() + $index }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->modelo }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->placa }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->numero_serie }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">No hay trailers disponibles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(!$trailersDisponibles->isEmpty())
                    <div class="mt-4 flex justify-center">
                        {{ $trailersDisponibles->links() }}
                    </div>
                @endif
            </div>

            <!-- Trailers Rentados -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Trailers Rentados</h2>
                
                <!-- Controles superiores -->
                <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center gap-2">
                        <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                        <select wire:change="$refresh" wire:model="perPageTrailersRent" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label class="font-semibold text-gray-900 text-base">registros:</label>
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                        <input wire:input="$refresh" wire:model="searchTrailersRent" 
                            type="text" 
                            placeholder="Buscar por ID o usuario..." 
                            class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900 placeholder-gray-400 text-base w-64">
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 max-h-96 overflow-y-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Modelo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Usuario</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Fecha Inicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Fecha Devolución Est.</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase sticky top-0">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($trailersRentados as $index => $renta)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailersRentados->firstItem() + $index }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $renta->trailer?->modelo ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $renta->trailer?->placa ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $renta->contratacion?->usuario?->nombre_completo ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $renta->fecha_renta ? $renta->fecha_renta->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $renta->fecha_devolucion_estimada ? $renta->fecha_devolucion_estimada->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">No hay trailers rentados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(!$trailersRentados->isEmpty())
                    <div class="mt-4 flex justify-center">
                        {{ $trailersRentados->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- TAB: Reportes -->
<div id="section-reportes" style="display: {{ $activeTab === 'reportes' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Reportes de Uso y Mantenimiento de Tráilers</h2>

            <!-- Controles superiores -->
            <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-2">
                    <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                    <select wire:change="$refresh" wire:model="perPageReportes" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="font-semibold text-gray-900 text-base">registros:</label>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                    <input wire:input="$refresh" wire:model="searchReportes" 
                        type="text" 
                        placeholder="Buscar por ID o modelo..." 
                        class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900 placeholder-gray-400 text-base w-64">
                    
                    <button wire:click="openReporteModal" class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base" 
                        style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);">
                        + Nuevo Reporte
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Modelo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Número de Serie</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Motivo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Estado</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($reportes as $index => $trailer)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $reportes->firstItem() + $index }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->modelo }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->placa }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->numero_serie }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->motivo_mantenimiento ?? 'Sin especificar' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fed7aa; color: #92400e;">En Mantenimiento</span></td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">
                                        <button wire:click="cambiarEstadoTrailer('{{ $trailer->id }}', 'disponible')" 
                                            class="text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                            style="background-color: #10b981;">
                                            Marcar Disponible
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay trailers en mantenimiento</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(!$reportes->isEmpty())
                <div class="mt-6 flex justify-center">
                    {{ $reportes->links() }}
                </div>
            @endif
        </div>

        <!-- Modal para crear reporte de mantenimiento -->
        @if($showReporteModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto" @click.away="$wire.closeReporteModal()">
                <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Reportar Trailer a Mantenimiento</h2>
                        <button class="text-white text-3xl hover:text-gray-300 transition" wire:click="closeReporteModal">✕</button>
                    </div>
                </div>

                <form wire:submit.prevent="crearReporte" class="p-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Seleccionar Trailer *</label>
                            <select wire:model="reporteForm.trailer_id" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 bg-white">
                                <option value="">Seleccionar trailer...</option>
                                @foreach($trailersParaReporte as $trailer)
                                    <option value="{{ $trailer->id }}">{{ $trailer->modelo }} - {{ $trailer->placa }}</option>
                                @endforeach
                            </select>
                            @error('reporteForm.trailer_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Motivo del Mantenimiento *</label>
                            <textarea wire:model="reporteForm.motivo" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 bg-white resize-none" rows="4" placeholder="Describe el motivo del mantenimiento..."></textarea>
                            @error('reporteForm.motivo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex gap-4 justify-end pt-6 mt-6 border-t-2 border-gray-200">
                        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300" wire:click="closeReporteModal">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300" style="background-color: #FF7A00;">
                            Enviar a Mantenimiento
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

    <script>
        // Las funciones de tabs ahora son manejadas por Livewire
    </script>
</div>