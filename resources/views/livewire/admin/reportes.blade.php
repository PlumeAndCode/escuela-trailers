<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE REPORTES</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button wire:click="setActiveTab('servicios')" 
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300"
                style="background-color: {{ $activeTab === 'servicios' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'servicios' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'servicios' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};">
                Servicios Más Contratados
            </button>
            <button wire:click="setActiveTab('ingresos')" 
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300"
                style="background-color: {{ $activeTab === 'ingresos' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'ingresos' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'ingresos' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};">
                Ingresos por Servicio
            </button>
            <button wire:click="setActiveTab('clientes')" 
                class="font-bold rounded-lg px-6 py-2 transition-all duration-300"
                style="background-color: {{ $activeTab === 'clientes' ? '#FF7A00' : '#ffffff' }}; color: {{ $activeTab === 'clientes' ? '#ffffff' : '#111827' }}; box-shadow: {{ $activeTab === 'clientes' ? '0 0 20px rgba(255, 122, 0, 0.6)' : '0 0 10px rgba(255, 122, 0, 0.4)' }};">
                Clientes
            </button>
        </div>

        <!-- TAB: Servicios Más Contratados -->
        <div style="display: {{ $activeTab === 'servicios' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Servicios Más Contratados</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Bloque 1: Resumen de estadísticas -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-md h-full">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Resumen General</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg p-4 border border-blue-200">
                            <p class="text-sm text-gray-600">Total Servicios</p>
                            <p class="text-3xl font-bold text-blue-700">{{ $totales['total_servicios'] }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-green-100 to-green-50 rounded-lg p-4 border border-green-200">
                            <p class="text-sm text-gray-600">Total Contrataciones</p>
                            <p class="text-3xl font-bold text-green-700">{{ $totales['total_contrataciones'] }}</p>
                        </div>
                        <div class="bg-gradient-to-r from-orange-100 to-orange-50 rounded-lg p-4 border border-orange-200 col-span-2">
                            <p class="text-sm text-gray-600">Ingresos Totales</p>
                            <p class="text-3xl font-bold text-orange-700">${{ number_format($totales['total_ingresos'], 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Bloque 2: Tabla ranking -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Posición</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Servicio</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base">Contrataciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse($serviciosMasContratados as $index => $servicio)
                                    <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                            @if($index < 3)
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $index === 0 ? 'bg-yellow-400' : ($index === 1 ? 'bg-gray-300' : 'bg-orange-400') }} text-white font-bold">
                                                    {{ $index + 1 }}
                                                </span>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $servicio->nombre_servicio }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base font-semibold">{{ $servicio->total_contrataciones }}</td>
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
            </div>

            <!-- Gráfica de Servicios Más Contratados -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-md">
                <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Gráfica de Contrataciones por Servicio</h3>
                <div class="relative" style="height: 400px;" wire:ignore>
                    <canvas id="chartServiciosContratados"></canvas>
                </div>
            </div>
        </div>

        <!-- TAB: Ingresos Por Servicio -->
        <div style="display: {{ $activeTab === 'ingresos' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Ingresos Por Servicio</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Bloque 1: Resumen de ingresos -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-md h-full">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Resumen de Ingresos</h3>
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-green-100 to-green-50 rounded-lg p-4 border border-green-200">
                            <p class="text-sm text-gray-600">Ingreso Total</p>
                            <p class="text-4xl font-bold text-green-700">${{ number_format($totales['total_ingresos'], 2) }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg p-4 border border-blue-200">
                                <p class="text-sm text-gray-600">Servicios Activos</p>
                                <p class="text-2xl font-bold text-blue-700">{{ $totales['total_servicios'] }}</p>
                            </div>
                            <div class="bg-gradient-to-r from-purple-100 to-purple-50 rounded-lg p-4 border border-purple-200">
                                <p class="text-sm text-gray-600">Contrataciones</p>
                                <p class="text-2xl font-bold text-purple-700">{{ $totales['total_contrataciones'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bloque 2: Tabla de ingresos por servicio -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Posición</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Servicio</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Pagos</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base">Ingreso Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse($ingresosPorServicio as $index => $servicio)
                                    <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                            @if($index < 3)
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $index === 0 ? 'bg-yellow-400' : ($index === 1 ? 'bg-gray-300' : 'bg-orange-400') }} text-white font-bold">
                                                    {{ $index + 1 }}
                                                </span>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $servicio->nombre_servicio }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $servicio->num_pagos }}</td>
                                        <td class="px-4 py-3 text-center text-gray-800 text-base font-semibold text-green-600">${{ number_format($servicio->total_ingresos, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr class="border-b border-gray-300">
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay ingresos registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Gráfica de Ingresos por Servicio -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-md">
                <h3 class="text-lg font-bold text-gray-800 mb-4">💰 Gráfica de Ganancias por Servicio</h3>
                <div class="relative" style="height: 400px;" wire:ignore>
                    <canvas id="chartIngresosPorServicio"></canvas>
                </div>
            </div>
        </div>

        <!-- TAB: Clientes -->
        <div style="display: {{ $activeTab === 'clientes' ? 'block' : 'none' }};">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Clientes</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Estadísticas de clientes -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 shadow-md text-white">
                    <p class="text-sm opacity-80">Total Clientes</p>
                    <p class="text-4xl font-bold">{{ $totales['total_clientes'] }}</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 shadow-md text-white">
                    <p class="text-sm opacity-80">Clientes Activos</p>
                    <p class="text-4xl font-bold">{{ $totales['clientes_activos'] }}</p>
                </div>
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-6 shadow-md text-white">
                    <p class="text-sm opacity-80">Clientes Inactivos</p>
                    <p class="text-4xl font-bold">{{ $totales['total_clientes'] - $totales['clientes_activos'] }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">#</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre del Cliente</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Email</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Teléfono</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Contrataciones</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Registro</th>
                                <th class="px-4 py-3 text-center font-bold text-white text-base">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($clientes as $index => $cliente)
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $cliente->nombre_completo }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $cliente->email }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $cliente->telefono ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-semibold">{{ $cliente->contrataciones_count }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $cliente->created_at?->format('d/m/Y') ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-center text-base">
                                        @if($cliente->estado_usuario)
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Activo</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-300">
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">No hay clientes registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Botón Descargar PDF -->
        <div class="mt-6 flex justify-end">
            <button wire:click="descargarPDF" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base flex items-center gap-2" 
                style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);">
                <span wire:loading.remove wire:target="descargarPDF">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </span>
                <span wire:loading wire:target="descargarPDF">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                Descargar PDF
            </button>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Script para las gráficas -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initReportCharts();
        });

        // También reinicializar cuando Livewire actualice el DOM
        document.addEventListener('livewire:navigated', function() {
            initReportCharts();
        });

        function initReportCharts() {
            // Datos para las gráficas desde PHP
            const serviciosData = @json($serviciosMasContratados);
            const ingresosData = @json($ingresosPorServicio);
            
            console.log('Datos servicios:', serviciosData);
            console.log('Datos ingresos:', ingresosData);
            
            // Colores para las gráficas
            const coloresBarras = [
                'rgba(255, 122, 0, 0.8)',   // Naranja (principal)
                'rgba(27, 51, 70, 0.8)',    // Azul oscuro
                'rgba(34, 197, 94, 0.8)',   // Verde
                'rgba(59, 130, 246, 0.8)',  // Azul
                'rgba(168, 85, 247, 0.8)',  // Púrpura
                'rgba(236, 72, 153, 0.8)',  // Rosa
                'rgba(245, 158, 11, 0.8)',  // Ámbar
                'rgba(20, 184, 166, 0.8)',  // Teal
            ];
            
            const coloresBordes = [
                'rgba(255, 122, 0, 1)',
                'rgba(27, 51, 70, 1)',
                'rgba(34, 197, 94, 1)',
                'rgba(59, 130, 246, 1)',
                'rgba(168, 85, 247, 1)',
                'rgba(236, 72, 153, 1)',
                'rgba(245, 158, 11, 1)',
                'rgba(20, 184, 166, 1)',
            ];

            // Destruir gráficas existentes si las hay
            const canvasServicios = document.getElementById('chartServiciosContratados');
            const canvasIngresos = document.getElementById('chartIngresosPorServicio');
            
            if (canvasServicios) {
                const existingChartServicios = Chart.getChart(canvasServicios);
                if (existingChartServicios) {
                    existingChartServicios.destroy();
                }
            }
            
            if (canvasIngresos) {
                const existingChartIngresos = Chart.getChart(canvasIngresos);
                if (existingChartIngresos) {
                    existingChartIngresos.destroy();
                }
            }

            // Gráfica de Servicios Más Contratados (Barras Horizontales)
            if (canvasServicios && serviciosData && serviciosData.length > 0) {
                new Chart(canvasServicios, {
                    type: 'bar',
                    data: {
                        labels: serviciosData.map(s => s.nombre_servicio),
                        datasets: [{
                            label: 'Contrataciones',
                            data: serviciosData.map(s => parseInt(s.total_contrataciones)),
                            backgroundColor: coloresBarras,
                            borderColor: coloresBordes,
                            borderWidth: 2,
                            borderRadius: 8,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(27, 51, 70, 0.9)',
                                titleFont: { size: 14, weight: 'bold' },
                                bodyFont: { size: 13 },
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        return ` ${context.parsed.x} contrataciones`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    stepSize: 1,
                                    font: { size: 12 }
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: { size: 12, weight: '500' }
                                }
                            }
                        }
                    }
                });
                console.log('Gráfica de servicios creada');
            } else {
                console.log('No se pudo crear gráfica de servicios:', {canvasServicios, serviciosData});
            }

            // Gráfica de Ingresos por Servicio (Dona / Doughnut)
            if (canvasIngresos && ingresosData && ingresosData.length > 0) {
                // Filtrar servicios con ingresos > 0
                const ingresosConDatos = ingresosData.filter(s => parseFloat(s.total_ingresos) > 0);
                
                if (ingresosConDatos.length > 0) {
                    new Chart(canvasIngresos, {
                        type: 'doughnut',
                        data: {
                            labels: ingresosConDatos.map(s => s.nombre_servicio),
                            datasets: [{
                                data: ingresosConDatos.map(s => parseFloat(s.total_ingresos)),
                                backgroundColor: coloresBarras,
                                borderColor: '#ffffff',
                                borderWidth: 3,
                                hoverOffset: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        padding: 20,
                                        font: { size: 13 },
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(27, 51, 70, 0.9)',
                                    titleFont: { size: 14, weight: 'bold' },
                                    bodyFont: { size: 13 },
                                    padding: 12,
                                    cornerRadius: 8,
                                    callbacks: {
                                        label: function(context) {
                                            const value = context.parsed;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((value / total) * 100).toFixed(1);
                                            return ` $${value.toLocaleString('es-MX', {minimumFractionDigits: 2})} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                    console.log('Gráfica de ingresos creada');
                } else {
                    // Mostrar mensaje si no hay ingresos
                    const ctx = canvasIngresos.getContext('2d');
                    ctx.font = '16px Arial';
                    ctx.fillStyle = '#6B7280';
                    ctx.textAlign = 'center';
                    ctx.fillText('No hay ingresos registrados', canvasIngresos.width / 2, canvasIngresos.height / 2);
                }
            }
        }
    </script>
</div>
