<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE LECCIONES</h1>
        </div>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Controles superiores -->
        <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Mostrar</label>
                <select wire:model.live="perPage" class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20 bg-white text-gray-900 text-base font-medium">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">registros</label>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Tipo:</label>
                <select wire:model.live="filtroTipo" class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium w-48">
                    <option value="">Lecciones de Cursos</option>
                    <option value="curso">Lecciones de Cursos</option>
                    <option value="individual">Lecciones Individuales</option>
                </select>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Estado:</label>
                <select wire:model.live="filtroEstado" class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium w-48">
                    <option value="">Todos</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en_progreso">En Progreso</option>
                    <option value="vista">Vista</option>
                    <option value="pagada">Pagada</option>
                </select>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Buscar:</label>
                <input wire:model.live.debounce.300ms="search" 
                    type="text" 
                    placeholder="Buscar por alumno o servicio..." 
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
            </div>
        </div>

        <!-- Tabla de lecciones -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            @if($lecciones->isEmpty())
                <div class="p-12 text-center bg-white">
                    <p class="text-gray-500 text-base font-medium">No hay lecciones registradas</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Alumno</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Servicio</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Lección</th>
                                @if($tipoActual === 'individual')
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Fecha Programada</th>
                                @endif
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Estado</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Descripcion</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($lecciones as $index => $leccion)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ ($lecciones->currentPage() - 1) * $lecciones->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ $leccion->contratacion?->usuario?->nombre_completo ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ Str::limit($leccion->contratacion?->servicio?->nombre_servicio ?? 'N/A', 25) }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        @if($tipoActual === 'avance')
                                            {{ $leccion->leccion?->nombre_leccion ?? 'N/A' }}
                                        @else
                                            Lección Individual
                                        @endif
                                    </td>
                                    @if($tipoActual === 'individual')
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                            {{ $leccion->fecha_programada ? $leccion->fecha_programada->format('d/m/Y H:i') : 'Sin programar' }}
                                        </td>
                                    @endif
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        @php
                                            $estado = $tipoActual === 'avance' ? $leccion->estado_avance : $leccion->estado_leccion;
                                        @endphp
                                        <span class="font-semibold rounded px-4 py-2 text-sm"
                                            style="@if($estado === 'vista' || $estado === 'completado') background-color: #10b981; color: #ffffff;
                                                @elseif($estado === 'pagada') background-color: #8b5cf6; color: #ffffff;
                                                @elseif($estado === 'en_progreso') background-color: #3b82f6; color: #ffffff;
                                                @else background-color: #f59e0b; color: #ffffff; @endif">
                                            {{ ucfirst(str_replace('_', ' ', $estado ?? 'pendiente')) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        @if($tipoActual === 'avance')
                                            {{ Str::limit($leccion->leccion?->observaciones ?? '-', 30) }}
                                        @else
                                            {{ Str::limit($leccion->observaciones ?? '-', 30) }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button wire:click="editarLeccion('{{ $leccion->id }}', '{{ $tipoActual }}')"
                                            class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                            style="background-color: #2563EB;"
                                            onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                            onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';">
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

        @if(!$lecciones->isEmpty())
            <div class="mt-6 flex justify-center">
                {{ $lecciones->links() }}
            </div>
        @endif

        <!-- Modal para editar lección -->
        @if($showModal)
            <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                    <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold">Editar Lección</h2>
                            <button wire:click="cerrarModal" class="text-white text-3xl hover:text-gray-300 transition">✕</button>
                        </div>
                    </div>

                    <form wire:submit="guardarCambios" class="p-8">
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Estado de la Lección *</label>
                            <select wire:model="editEstadoAvance" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                <option value="">Seleccione estado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en_progreso">En Progreso</option>
                                <option value="vista">Vista</option>
                                <option value="pagada">Pagada</option>
                            </select>
                            @error('editEstadoAvance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Observaciones</label>
                            <textarea wire:model="editObservaciones" 
                                rows="4"
                                placeholder="Agregar observaciones sobre el progreso del alumno..."
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white"></textarea>
                            @error('editObservaciones') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                            <button type="button" wire:click="cerrarModal" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm">
                                Cancelar
                            </button>
                            <button type="submit" 
                                class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                                style="background-color: #FF7A00;"
                                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>