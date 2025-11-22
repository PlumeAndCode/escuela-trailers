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
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">ID Usuario</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Curso</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Lecciones del Curso</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Lecciones Tomadas</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">% Completado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($avances as $avance)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $avance->id_usuario }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $avance->nombre }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $avance->curso }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $avance->lecciones_total }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $avance->lecciones_tomadas }}</td>
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
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">ID Trailer</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Modelo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Año</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Capacidad (Ton)</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Descripción</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase sticky top-0">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($trailersDisponibles as $trailer)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->id_trailer }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->modelo }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->placa }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->año }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->capacidad }}</td>
                                    <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">{{ $trailer->descripcion }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">No hay trailers disponibles</td>
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
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">ID Trailer</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Modelo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Usuario</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Fecha Inicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Fecha Devolución</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Notas</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase sticky top-0">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($trailersRentados as $trailer)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->id_trailer }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->modelo }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->placa }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->usuario }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->fecha_inicio }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $trailer->fecha_devolucion }}</td>
                                    <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">{{ $trailer->notas }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">No hay trailers rentados</td>
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
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">ID Trailer</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Modelo</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Año</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Estado</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Reportes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($reportes as $reporte)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $reporte->id_trailer }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $reporte->modelo }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $reporte->placa }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">{{ $reporte->año }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fed7aa; color: #92400e;">En Mantenimiento</span></td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">
                                        <button class="text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                            style="background-color: #2563EB;"
                                            onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                            onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                            onclick="openReportesModal('{{ $reporte->id_trailer }}', '{{ $reporte->modelo }}', '{{ $reporte->placa }}')">
                                            {{ $reporte->cantidad_reportes }}
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay reportes disponibles</td>
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

        <!-- Modal de Reportes -->
        <div id="reportesModal" style="display:none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-2xl w-full max-w-4xl max-h-96 overflow-y-auto">
                <!-- Header del Modal -->
                <div style="background-color: #1b3346;" class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0">
                    <h3 class="text-xl font-bold text-white" id="modalTitle">Reportes de Uso y Mantenimiento</h3>
                    <button onclick="closeReportesModal()" class="text-white hover:text-gray-300 font-bold text-2xl">&times;</button>
                </div>

                <!-- Contenido del Modal -->
                <div class="p-6">
                    <!-- Tabs del Modal -->
                    <div class="flex gap-4 mb-6 border-b border-gray-200">
                        <button onclick="switchReportTab('historial', this)" class="px-4 py-2 font-bold text-gray-900 border-b-2 border-gray-900" style="border-color: #1b3346;">
                            Historial de Reportes
                        </button>
                        <button onclick="switchReportTab('nuevo', this)" class="px-4 py-2 font-bold text-gray-600 border-b-2 border-transparent hover:text-gray-900">
                            Crear Nuevo Reporte
                        </button>
                    </div>

                    <!-- Historial de Reportes -->
                    <div id="tab-historial">
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr style="background-color: #f3f4f6;">
                                        <th class="px-4 py-3 text-left font-bold text-gray-900 text-base border-b border-gray-300">Fecha</th>
                                        <th class="px-4 py-3 text-left font-bold text-gray-900 textbase border-b border-gray-300">Tipo de Mantenimiento</th>
                                        <th class="px-4 py-3 text-left font-bold text-gray-900 textbase border-b border-gray-300">Descripción</th>
                                        <th class="px-4 py-3 text-left font-bold text-gray-900 textbase border-b border-gray-300">Técnico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-gray-800 text-base">15/11/2024</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Inspección General</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Inspección de frenos y neumáticos</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Juan Rodríguez</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-gray-800 textbase">12/11/2024</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Cambio de Aceite</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Cambio de aceite y filtro</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Carlos López</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Crear Nuevo Reporte -->
                    <div id="tab-nuevo" style="display:none;">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Tipo de Mantenimiento</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    <option>Seleccionar tipo de mantenimiento</option>
                                    <option>Inspección General</option>
                                    <option>Cambio de Aceite</option>
                                    <option>Reparación de Frenos</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Descripción del Trabajo</label>
                                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 resize-none" rows="4" placeholder="Describe el trabajo realizado..."></textarea>
                            </div>

                            <div class="flex gap-4 mt-6">
                                <button class="flex-1 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                    style="background-color: #10b981;">
                                    Guardar Reporte
                                </button>
                                <button onclick="closeReportesModal()" class="flex-1 text-gray-900 font-bold rounded-lg px-4 py-2 transition-all duration-300 bg-gray-200">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchControlTab(tab, el) {
            const secAvance = document.getElementById('section-avance');
            const secTrailers = document.getElementById('section-trailers');
            const secReportes = document.getElementById('section-reportes');

            secAvance.style.display = (tab === 'avance') ? '' : 'none';
            secTrailers.style.display = (tab === 'trailers') ? '' : 'none';
            secReportes.style.display = (tab === 'reportes') ? '' : 'none';

            const container = el.parentElement;
            Array.from(container.querySelectorAll('button')).forEach(b => {
                b.style.backgroundColor = '#ffffff';
                b.style.color = '#111827';
                b.style.boxShadow = '0 0 10px rgba(255, 122, 0, 0.4)';
            });
            el.style.backgroundColor = '#FF7A00';
            el.style.color = '#ffffff';
            el.style.boxShadow = '0 0 20px rgba(255, 122, 0, 0.6)';
        }

        function openReportesModal(trailerId, modelo, placa) {
            document.getElementById('modalTitle').textContent = `Reportes - ${modelo} (${placa})`;
            document.getElementById('reportesModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeReportesModal() {
            document.getElementById('reportesModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function switchReportTab(tab, el) {
            const tabHistorial = document.getElementById('tab-historial');
            const tabNuevo = document.getElementById('tab-nuevo');

            tabHistorial.style.display = (tab === 'historial') ? '' : 'none';
            tabNuevo.style.display = (tab === 'nuevo') ? '' : 'none';

            const container = el.parentElement;
            Array.from(container.querySelectorAll('button')).forEach(b => {
                b.style.color = '#4b5563';
                b.style.borderColor = 'transparent';
            });
            
            el.style.color = '#111827';
            el.style.borderColor = '#1b3346';
        }

        document.getElementById('reportesModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReportesModal();
            }
        });
    </script>
</div>