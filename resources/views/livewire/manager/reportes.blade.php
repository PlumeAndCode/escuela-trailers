<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">REPORTES OPERATIVOS</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button wire:click="cambiarTab('lecciones')"
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300
                    {{ $tabActivo === 'lecciones' ? 'text-white' : 'text-gray-900 bg-white' }}"
                style="{{ $tabActivo === 'lecciones' ? 'background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);' : 'box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);' }}">
                Lecciones
            </button>
            <button wire:click="cambiarTab('rentas')"
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300
                    {{ $tabActivo === 'rentas' ? 'text-white' : 'text-gray-900 bg-white' }}"
                style="{{ $tabActivo === 'rentas' ? 'background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);' : 'box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);' }}">
                Rentas Activas
            </button>
            <button wire:click="cambiarTab('pagos')"
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300
                    {{ $tabActivo === 'pagos' ? 'text-white' : 'text-gray-900 bg-white' }}"
                style="{{ $tabActivo === 'pagos' ? 'background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);' : 'box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);' }}">
                Pagos Pendientes
            </button>
        </div>

        <!-- TAB: Lecciones -->
        @if($tabActivo === 'lecciones')
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Progreso de Cursos y Lecciones</h2>
                    <button wire:click="exportarLeccionesPDF"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300 flex items-center gap-2">
                        Exportar PDF
                    </button>
                </div>

                <!-- SECCIÓN: Progreso de Cursos -->
                <h3 class="text-xl font-bold text-gray-800 mb-4">Progreso de Cursos</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Gráfica de lecciones de cursos -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <h4 class="text-lg font-bold mb-4 text-gray-800">Estado de Lecciones (Cursos)</h4>
                        <div class="h-72" wire:ignore>
                            <canvas id="chartLecciones"
                                data-labels="{{ json_encode($datosGraficaLecciones['labels']) }}"
                                data-values="{{ json_encode($datosGraficaLecciones['data']) }}"
                                data-colors="{{ json_encode($datosGraficaLecciones['colors']) }}">
                            </canvas>
                        </div>
                    </div>

                    <!-- Tabla progreso cursos -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <h4 class="text-lg font-bold mb-4 text-gray-800">Avance por Alumno</h4>
                        <div class="overflow-y-auto max-h-72">
                            <table class="w-full border-collapse">
                                <thead class="sticky top-0 bg-white">
                                    <tr style="background-color: #1b3346;">
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Alumno</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Curso</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm">Progreso</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($progresoLecciones as $progreso)
                                        <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">{{ $progreso->alumno }}</td>
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">{{ Str::limit($progreso->servicio, 18) }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="flex flex-col items-center gap-1">
                                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                                        <div class="h-3 rounded-full transition-all duration-500"
                                                            style="width: {{ $progreso->porcentaje }}%; background-color: {{ $progreso->porcentaje >= 75 ? '#10b981' : ($progreso->porcentaje >= 50 ? '#f59e0b' : '#3b82f6') }};"></div>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-bold text-sm"
                                                            style="color: {{ $progreso->porcentaje >= 75 ? '#10b981' : ($progreso->porcentaje >= 50 ? '#f59e0b' : '#3b82f6') }};">
                                                            {{ $progreso->porcentaje }}%
                                                        </span>
                                                        <span class="text-gray-500 text-xs">({{ $progreso->completadas }}/{{ $progreso->total_lecciones }})</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center text-gray-500">No hay cursos activos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Lecciones Individuales -->
                <h3 class="text-xl font-bold text-gray-800 mb-4">Lecciones Individuales</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Gráfica de lecciones individuales -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <h4 class="text-lg font-bold mb-4 text-gray-800">Estado de Lecciones Individuales</h4>
                        <div class="h-72" wire:ignore>
                            <canvas id="chartLeccionesIndividuales"
                                data-labels="{{ json_encode($datosGraficaLeccionesIndividuales['labels']) }}"
                                data-values="{{ json_encode($datosGraficaLeccionesIndividuales['data']) }}"
                                data-colors="{{ json_encode($datosGraficaLeccionesIndividuales['colors']) }}">
                            </canvas>
                        </div>
                    </div>

                    <!-- Tabla lecciones individuales -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <h4 class="text-lg font-bold mb-4 text-gray-800">Detalle de Lecciones</h4>
                        <div class="overflow-y-auto max-h-72">
                            <table class="w-full border-collapse">
                                <thead class="sticky top-0 bg-white">
                                    <tr style="background-color: #1b3346;">
                                        <th class="px-3 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Alumno</th>
                                        <th class="px-3 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Fecha</th>
                                        <th class="px-3 py-3 text-center font-bold text-white text-sm">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($leccionesIndividuales as $leccion)
                                        <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-3 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ $leccion->contratacion?->usuario?->nombre_completo ?? 'N/A' }}
                                            </td>
                                            <td class="px-3 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ $leccion->fecha_programada ? $leccion->fecha_programada->format('d/m/Y H:i') : 'Sin programar' }}
                                            </td>
                                            <td class="px-3 py-3 text-center">
                                                <span class="font-semibold rounded px-2 py-1 text-xs"
                                                    style="@if($leccion->estado_leccion === 'completada') background-color: #10b981; color: #ffffff;
                                                        @elseif($leccion->estado_leccion === 'en_progreso') background-color: #3b82f6; color: #ffffff;
                                                        @elseif($leccion->estado_leccion === 'bloqueada') background-color: #ef4444; color: #ffffff;
                                                        @else background-color: #f59e0b; color: #ffffff; @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $leccion->estado_leccion)) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center text-gray-500">No hay lecciones individuales</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- TAB: Rentas -->
        @if($tabActivo === 'rentas')
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Rentas de Tráileres</h2>
                    <button wire:click="exportarRentasPDF"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300 flex items-center gap-2">
                        Exportar PDF
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Gráfica de rentas -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <h3 class="text-lg font-bold mb-4 text-gray-800">Estado de Rentas</h3>
                        <div class="h-72" wire:ignore>
                            <canvas id="chartRentas"
                                data-labels="{{ json_encode($datosGraficaRentas['labels']) }}"
                                data-values="{{ json_encode($datosGraficaRentas['data']) }}"
                                data-colors="{{ json_encode($datosGraficaRentas['colors']) }}">
                            </canvas>
                        </div>
                    </div>

                    <!-- Tabla rentas -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <div class="overflow-y-auto max-h-96">
                            <table class="w-full border-collapse">
                                <thead class="sticky top-0 bg-white">
                                    <tr style="background-color: #1b3346;">
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Tráiler</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Cliente</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Devolución</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($rentasActivas as $renta)
                                        <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200 
                                            {{ $renta->estado_renta === 'atrasada' ? 'bg-red-50' : ($renta->proximo_vencer ? 'bg-orange-50' : '') }}">
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ $renta->trailer?->modelo }} - {{ $renta->trailer?->placa }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ $renta->contratacion?->usuario?->nombre_completo ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ $renta->fecha_devolucion_estimada ? $renta->fecha_devolucion_estimada->format('d/m/Y') : 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm">
                                                @if($renta->estado_renta === 'devuelta')
                                                    <span class="font-semibold rounded px-3 py-1 text-sm"
                                                        style="background-color: #10b981; color: #ffffff;">
                                                        Devuelta
                                                    </span>
                                                @elseif($renta->estado_renta === 'atrasada')
                                                    <span class="font-semibold rounded px-3 py-1 text-sm"
                                                        style="background-color: #ef4444; color: #ffffff;">
                                                        Atrasada
                                                    </span>
                                                @elseif($renta->proximo_vencer)
                                                    <span class="font-semibold rounded px-3 py-1 text-sm"
                                                        style="background-color: #f59e0b; color: #ffffff;">
                                                        {{ $renta->dias_restantes }} días
                                                    </span>
                                                @else
                                                    <span class="font-semibold rounded px-3 py-1 text-sm"
                                                        style="background-color: #3b82f6; color: #ffffff;">
                                                        Activa
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay rentas registradas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- TAB: Pagos Pendientes -->
        @if($tabActivo === 'pagos')
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Pagos Pendientes</h2>
                    <button wire:click="exportarPagosPDF"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300 flex items-center gap-2">
                        Exportar PDF
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Gráfica de pagos -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <h3 class="text-lg font-bold mb-4 text-gray-800">Estado de Pagos</h3>
                        <div class="h-72" wire:ignore>
                            <canvas id="chartPagos"
                                data-labels="{{ json_encode($datosGraficaPagos['labels']) }}"
                                data-values="{{ json_encode($datosGraficaPagos['data']) }}"
                                data-colors="{{ json_encode($datosGraficaPagos['colors']) }}">
                            </canvas>
                        </div>
                    </div>

                    <!-- Tabla pagos pendientes -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                        <div class="overflow-y-auto max-h-96">
                            <table class="w-full border-collapse">
                                <thead class="sticky top-0 bg-white">
                                    <tr style="background-color: #1b3346;">
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Cliente</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Servicio</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm border-r border-gray-300">Monto</th>
                                        <th class="px-4 py-3 text-center font-bold text-white text-sm">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($pagosPendientes as $pago)
                                        <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ $pago->contratacion?->usuario?->nombre_completo ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm border-r border-gray-300">
                                                {{ Str::limit($pago->contratacion?->servicio?->nombre_servicio ?? 'N/A', 20) }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-800 text-sm font-semibold border-r border-gray-300">
                                                ${{ number_format($pago->monto_pagado, 2) }}
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm">
                                                <span class="font-semibold rounded px-3 py-1 text-sm"
                                                    style="@if($pago->estado_pago === 'vencido') background-color: #ef4444; color: #ffffff;
                                                        @elseif($pago->estado_pago === 'parcial') background-color: #f59e0b; color: #ffffff;
                                                        @elseif($pago->estado_pago === 'pagado') background-color: #10b981; color: #ffffff;
                                                        @else background-color: #eab308; color: #ffffff; @endif">
                                                    {{ ucfirst($pago->estado_pago) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay pagos pendientes</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
    <script>
        // Almacenar instancias de gráficas
        window.chartInstances = window.chartInstances || {};

        // Función para crear gráficas
        function crearGraficaPie(canvasId) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;

            const labels = JSON.parse(canvas.dataset.labels || '[]');
            const data = JSON.parse(canvas.dataset.values || '[]');
            const colors = JSON.parse(canvas.dataset.colors || '[]');

            // Destruir gráfica existente si hay
            if (window.chartInstances[canvasId]) {
                window.chartInstances[canvasId].destroy();
                delete window.chartInstances[canvasId];
            }

            // Verificar que hay datos para mostrar
            const totalData = data.reduce((a, b) => a + b, 0);
            if (totalData === 0) {
                // Mostrar mensaje de "sin datos"
                const ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.font = '14px Arial';
                ctx.fillStyle = '#666';
                ctx.textAlign = 'center';
                ctx.fillText('Sin datos disponibles', canvas.width / 2, canvas.height / 2);
                return;
            }

            window.chartInstances[canvasId] = new Chart(canvas, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors,
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }

        // Función para inicializar todas las gráficas según el tab actual
        function inicializarGraficas() {
            crearGraficaPie('chartLecciones');
            crearGraficaPie('chartLeccionesIndividuales');
            crearGraficaPie('chartRentas');
            crearGraficaPie('chartPagos');
        }

        // Inicializar al cargar el componente
        setTimeout(inicializarGraficas, 200);

        // Re-inicializar al cambiar de tab
        $wire.on('tabChanged', () => {
            setTimeout(inicializarGraficas, 200);
        });
    </script>
    @endscript
</div>