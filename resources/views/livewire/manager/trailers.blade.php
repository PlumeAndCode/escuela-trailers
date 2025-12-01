<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE RENTAS DE TRÁILERS</h1>
        </div>

        <!-- Mensajes -->
        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ session('error') }}
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
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Estado:</label>
                <select wire:model.live="filtroEstado" class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium w-48">
                    <option value="">Todos</option>
                    <option value="activa">Activa</option>
                    <option value="devuelta">Devuelta</option>
                    <option value="atrasada">Atrasada</option>
                </select>
            </div>

            <div class="flex items-center gap-3 flex-wrap min-w-max">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Buscar:</label>
                <input wire:model.live.debounce.300ms="search" 
                    type="text" 
                    placeholder="Tráiler, placa o cliente..." 
                    class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-64">
                
                <button wire:click="abrirModalRenta"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base" 
                    style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                    onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';">
                    + Nueva Renta
                </button>
            </div>
        </div>

        <!-- Tabla de rentas -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            @if($rentas->isEmpty())
                <div class="p-12 text-center bg-white">
                    <p class="text-gray-500 text-base font-medium">No hay rentas de tráileres registradas</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Tráiler</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Placa</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Cliente</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Fecha Renta</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Fecha Devolución Est.</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Estado</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($rentas as $index => $renta)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ ($rentas->currentPage() - 1) * $rentas->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ $renta->trailer?->modelo ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ $renta->trailer?->placa ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ $renta->contratacion?->usuario?->nombre_completo ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ $renta->fecha_renta ? $renta->fecha_renta->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        {{ $renta->fecha_devolucion_estimada ? $renta->fecha_devolucion_estimada->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        <span class="font-semibold rounded px-3 py-1 text-sm"
                                            style="@if($renta->estado_renta === 'activa') background-color: #3b82f6; color: #ffffff;
                                                @elseif($renta->estado_renta === 'devuelta') background-color: #10b981; color: #ffffff;
                                                @elseif($renta->estado_renta === 'atrasada') background-color: #ef4444; color: #ffffff;
                                                @endif">
                                            {{ ucfirst($renta->estado_renta ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex gap-2 justify-center items-center flex-wrap">
                                            @if($renta->estado_renta === 'activa')
                                                <button wire:click="editarRenta('{{ $renta->id }}')"
                                                    class="font-bold rounded text-white text-sm py-2 px-4 transition-all duration-300" 
                                                    style="background-color: #2563EB;"
                                                    onmouseover="this.style.boxShadow='0 0 15px rgba(37, 99, 235, 0.8)';"
                                                    onmouseout="this.style.boxShadow='none';">
                                                    Editar
                                                </button>
                                                <button wire:click="abrirModalDevolucion('{{ $renta->id }}')"
                                                    class="font-bold rounded text-white text-sm py-2 px-4 transition-all duration-300 bg-green-600 hover:bg-green-700">
                                                    Devolver
                                                </button>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if(!$rentas->isEmpty())
            <div class="mt-6 flex justify-center">
                {{ $rentas->links() }}
            </div>
        @endif

        <!-- Modal para nueva renta -->
        @if($showModalRenta)
            <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                    <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold">Nueva Renta de Tráiler</h2>
                            <button wire:click="cerrarModalRenta" class="text-white text-3xl hover:text-gray-300 transition">✕</button>
                        </div>
                    </div>

                    <form wire:submit="crearRenta" class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Tráiler *</label>
                                <select wire:model="rentaTrailerId" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="">Seleccione un tráiler</option>
                                    @foreach($trailersDisponibles as $trailer)
                                        <option value="{{ $trailer->id }}">{{ $trailer->modelo }} - {{ $trailer->placa }}</option>
                                    @endforeach
                                </select>
                                @error('rentaTrailerId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Cliente *</label>
                                <select wire:model="rentaClienteId" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                                    @endforeach
                                </select>
                                @error('rentaClienteId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha de Renta *</label>
                                <input type="date" wire:model="rentaFechaInicio" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                @error('rentaFechaInicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha Devolución Estimada *</label>
                                <input type="date" wire:model="rentaFechaDevolucion" 
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                @error('rentaFechaDevolucion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                            <button type="button" wire:click="cerrarModalRenta" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm">
                                Cancelar
                            </button>
                            <button type="submit" 
                                class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                                style="background-color: #FF7A00;">
                                Crear Renta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Modal para editar renta -->
        @if($showModalEditar)
            <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                    <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold">Editar Renta</h2>
                            <button wire:click="cerrarModalEditar" class="text-white text-3xl hover:text-gray-300 transition">✕</button>
                        </div>
                    </div>

                    <form wire:submit="guardarCambiosRenta" class="p-8">
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha Devolución Estimada *</label>
                            <input type="date" wire:model="editFechaDevolucion" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            @error('editFechaDevolucion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Estado de la Renta *</label>
                            <select wire:model="editEstadoRenta" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                                <option value="activa">Activa</option>
                                <option value="devuelta">Devuelta</option>
                                <option value="atrasada">Atrasada</option>
                            </select>
                            @error('editEstadoRenta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                            <button type="button" wire:click="cerrarModalEditar" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm">
                                Cancelar
                            </button>
                            <button type="submit" 
                                class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                                style="background-color: #FF7A00;">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Modal para devolución -->
        @if($showModalDevolucion)
            <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                    <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold">Registrar Devolución</h2>
                            <button wire:click="cerrarModalDevolucion" class="text-white text-3xl hover:text-gray-300 transition">✕</button>
                        </div>
                    </div>

                    <form wire:submit="marcarDevolucion" class="p-8">
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha Real de Devolución *</label>
                            <input type="date" wire:model="devolucionFechaReal" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white" required>
                            @error('devolucionFechaReal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg mb-6">
                            <p class="text-yellow-800 text-sm">
                                ⚠️ Al registrar la devolución, el tráiler quedará disponible nuevamente para rentar.
                            </p>
                        </div>

                        <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                            <button type="button" wire:click="cerrarModalDevolucion" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm">
                                Cancelar
                            </button>
                            <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm">
                                Confirmar Devolución
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>