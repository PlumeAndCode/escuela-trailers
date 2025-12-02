<div
    x-data="{ 
        toasts: [],
        addToast(toast) {
            const id = Date.now();
            this.toasts.push({ id, ...toast });
            setTimeout(() => this.removeToast(id), 4000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }"
    @toast.window="addToast($event.detail)"
>
    <!-- Toast Notifications -->
    <div class="fixed top-5 right-5 z-50 space-y-2">
        <template x-for="toast in toasts" :key="toast.id">
            <div 
                x-show="true"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                :class="{
                    'bg-green-500': toast.type === 'success',
                    'bg-red-500': toast.type === 'error',
                    'bg-amber-500': toast.type === 'warning',
                    'bg-blue-500': toast.type === 'info'
                }"
                class="text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3"
            >
                <template x-if="toast.type === 'success'">
                    <i class="fas fa-check-circle"></i>
                </template>
                <template x-if="toast.type === 'error'">
                    <i class="fas fa-exclamation-circle"></i>
                </template>
                <span x-text="toast.message"></span>
                <button @click="removeToast(toast.id)" class="ml-2 hover:opacity-75">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </template>
    </div>

    <div class="p-6 bg-gray-100 min-h-screen">
        <!-- Page Title -->
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">Servicios Contratados</h1>
        </div>

        <!-- Page Subtitle and Add Button -->
        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-600">Aquí puedes ver tus servicios activos y próximos pagos o vencimientos</p>
            <button wire:click="openAddModal" 
                class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300 flex items-center" 
                style="background-color: #10b981;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(16, 185, 129, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(16, 185, 129, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-plus mr-2"></i>
                Añadir Servicios
            </button>
        </div>

        <!-- Filters -->
        <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Buscar:</label>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Buscar por nombre de servicio..."
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80"
                >
            </div>
            <div class="flex items-center gap-3">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Estado:</label>
                <select 
                    wire:model.live="filtroEstado"
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium w-48"
                >
                    <option value="">Todos los estados</option>
                    <option value="activo">Activos</option>
                    <option value="cancelado">Cancelados</option>
                    <option value="completado">Completados</option>
                </select>
            </div>
        </div>

        <!-- Services Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 mb-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr style="background-color: #1b3346;">
                        <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">#</th>
                        <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Servicio</th>
                        <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Fecha Inicio</th>
                        <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Estado</th>
                        <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Próximo Pago</th>
                        <th class="px-4 py-3 text-center font-bold text-white text-base">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($contrataciones as $index => $contratacion)
                    <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-center border-r border-gray-300">
                            <div class="font-semibold text-gray-800">{{ $contratacion->servicio->nombre_servicio ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-600">{{ Str::limit($contratacion->servicio->descripcion ?? '', 50) }}</div>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $contratacion->fecha_contratacion->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-center border-r border-gray-300">
                            @if($contratacion->estado_contratacion === 'activo')
                                <span class="font-semibold rounded px-4 py-2 text-sm" style="background-color: #10b981; color: #ffffff;">Activo</span>
                            @elseif($contratacion->estado_contratacion === 'cancelado')
                                <span class="font-semibold rounded px-4 py-2 text-sm" style="background-color: #ef4444; color: #ffffff;">Cancelado</span>
                            @else
                                <span class="font-semibold rounded px-4 py-2 text-sm" style="background-color: #3b82f6; color: #ffffff;">{{ ucfirst($contratacion->estado_contratacion) }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center text-base border-r border-gray-300">
                            @if($contratacion->pagos->first())
                                <span class="text-amber-600 font-semibold">{{ $contratacion->pagos->first()->fecha_pago->format('d/m/Y') }}</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($contratacion->estado_contratacion === 'activo')
                                <button 
                                    wire:click="confirmarCancelacion('{{ $contratacion->id }}')"
                                    class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                    style="background-color: #ef4444;"
                                    onmouseover="this.style.boxShadow='0 0 20px rgba(239, 68, 68, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                    onmouseout="this.style.boxShadow='0 0 10px rgba(239, 68, 68, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                                    Anular Servicio
                                </button>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center bg-white">
                            <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-base font-medium">No tienes servicios contratados</p>
                            <button wire:click="openAddModal" class="mt-3 text-amber-600 hover:text-amber-700 font-semibold">
                                Contratar un servicio
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($contrataciones->hasPages())
        <div class="mb-6 flex justify-center">
            {{ $contrataciones->links() }}
        </div>
        @endif

        <!-- Additional Services Info -->
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-amber-800 mb-3">Servicios Disponibles</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="flex items-center">
                    <span class="text-amber-500 mr-2">✓</span>
                    <span>Curso completo de manejo</span>
                </div>
                <div class="flex items-center">
                    <span class="text-amber-500 mr-2">✓</span>
                    <span>Lecciones individuales</span>
                </div>
                <div class="flex items-center">
                    <span class="text-amber-500 mr-2">✓</span>
                    <span>Trámite de licencia</span>
                </div>
                <div class="flex items-center">
                    <span class="text-amber-500 mr-2">✓</span>
                    <span>Renta de tráiler</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    @if($showAddModal)
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] flex items-center justify-center p-5">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 max-w-2xl w-full relative shadow-2xl border border-gray-100">
            <!-- Close Button -->
            <button wire:click="closeAddModal" class="absolute right-5 top-4 text-2xl text-gray-600 hover:text-amber-600 transition-colors">
                &times;
            </button>
            
            <div class="flex flex-col">
                <!-- Title -->
                <h2 class="text-gray-900 text-2xl font-bold mb-6 text-center">Añadir Nuevo Servicio</h2>
                
                <!-- Services List -->
                <div class="space-y-4 max-h-96 overflow-y-auto mb-6">
                    @forelse($serviciosDisponibles as $servicio)
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:border-amber-300 transition-all {{ $servicioSeleccionado && $servicioSeleccionado->id === $servicio->id ? 'border-amber-500 bg-amber-50' : '' }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $servicio->nombre_servicio }}</h4>
                                <p class="text-gray-600 text-sm mt-1">{{ Str::limit($servicio->descripcion, 60) }}</p>
                                <p class="text-amber-600 font-bold mt-2">${{ number_format($servicio->precio, 2) }}</p>
                            </div>
                            <button 
                                wire:click="seleccionarServicio('{{ $servicio->id }}')"
                                class="{{ $servicioSeleccionado && $servicioSeleccionado->id === $servicio->id ? 'bg-green-500 hover:bg-green-600' : 'bg-amber-500 hover:bg-amber-600' }} text-white px-4 py-2 rounded-lg font-semibold transition-colors"
                            >
                                {{ $servicioSeleccionado && $servicioSeleccionado->id === $servicio->id ? '✓ Seleccionado' : 'Seleccionar' }}
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-box-open text-4xl mb-3"></i>
                        <p>No hay servicios disponibles en este momento</p>
                    </div>
                    @endforelse
                </div>

                <!-- Selected Service -->
                @if($servicioSeleccionado)
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                    <h4 class="font-semibold text-amber-800 mb-2">Servicio Seleccionado:</h4>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="font-semibold">{{ $servicioSeleccionado->nombre_servicio }}</span>
                            <span class="text-amber-600 font-bold ml-4">${{ number_format($servicioSeleccionado->precio, 2) }}</span>
                        </div>
                        <button 
                            wire:click="contratar"
                            wire:loading.attr="disabled"
                            class="bg-green-500 hover:bg-green-600 disabled:bg-gray-400 text-white px-6 py-2 rounded-lg font-semibold transition-colors"
                        >
                            <span wire:loading.remove wire:target="contratar">Contratar Servicio</span>
                            <span wire:loading wire:target="contratar">Procesando...</span>
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Confirm Cancel Modal -->
    @if($showConfirmModal)
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] flex items-center justify-center p-5">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 max-w-md w-full relative shadow-2xl border border-gray-100">
            <div class="flex flex-col items-center text-center">
                <!-- Warning Icon -->
                <div class="w-16 h-16 bg-red-500 text-white rounded-full flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                
                <h2 class="text-gray-900 text-xl font-bold mb-2">¿Cancelar Servicio?</h2>
                <p class="text-gray-600 mb-6">Esta acción no se puede deshacer. ¿Estás seguro de que deseas anular este servicio?</p>

                <div class="flex gap-4 w-full">
                    <button 
                        wire:click="cerrarConfirmModal"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold transition-colors"
                    >
                        No, Mantener
                    </button>
                    <button 
                        wire:click="cancelarServicio"
                        wire:loading.attr="disabled"
                        class="flex-1 bg-red-500 hover:bg-red-600 disabled:bg-gray-400 text-white py-3 rounded-lg font-semibold transition-colors"
                    >
                        <span wire:loading.remove wire:target="cancelarServicio">Sí, Cancelar</span>
                        <span wire:loading wire:target="cancelarServicio">Cancelando...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>