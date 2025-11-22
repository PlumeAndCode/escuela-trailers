<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE REPORTES OPERATIVOS</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button class="text-white font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                onclick="switchReportesTab('lecciones', this)">
                Lecciones Completadas
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchReportesTab('rentas', this)">
                Rentas Activas
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchReportesTab('pagos', this)">
                Pagos Pendientes
            </button>
        </div>

        <!-- TAB: Lecciones Completadas -->
        <div id="section-lecciones">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Lecciones Completadas</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bloque 1: Placeholder para gráficos -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="border-2 border-dashed border-slate-400 rounded-lg bg-slate-50 h-80 flex items-center justify-center text-slate-600 font-semibold">
                        Área para gráficos (barras, pastel, etc.)
                    </div>
                </div>

                <!-- Bloque 2: Tabla lecciones completadas -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                    <div class="overflow-y-auto max-h-96">
                        <table class="w-full border-collapse">
                            <thead class="sticky top-0 bg-white">
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre del Alumno</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Servicio</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base">Progreso</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Juan Pérez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Curso A1 Licencia</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">
                                            8/8
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">María García</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Curso B Transporte</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">
                                            6/10
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Carlos López</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Certificación Remolques</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">
                                            5/12
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Ana Martínez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Curso A1 Licencia</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">
                                            8/8
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Roberto Sánchez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Mantenimiento Preventivo</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">
                                            3/6
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: Rentas Activas -->
        <div id="section-rentas" style="display:none;">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Rentas Activas</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bloque 1: Placeholder para gráficos -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="border-2 border-dashed border-slate-400 rounded-lg bg-slate-50 h-80 flex items-center justify-center text-slate-600 font-semibold">
                        Área para gráficos (barras, pastel, etc.)
                    </div>
                </div>

                <!-- Bloque 2: Tabla rentas activas -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                    <div class="overflow-y-auto max-h-96">
                        <table class="w-full border-collapse">
                            <thead class="sticky top-0 bg-white">
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Nombre del Tráiler</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Cliente</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Fecha Devolución</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Trailer 001</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Juan Pérez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">2025-11-25</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-4 py-2 text-sm inline-block" style="background-color: #dcfce7; color: #166534;">Activa</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Trailer 002</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">María García</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">2025-11-30</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-4 py-2 text-sm inline-block" style="background-color: #dcfce7; color: #166534;">Activa</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Trailer 003</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Carlos López</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">2025-11-22</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-4 py-2 text-sm inline-block text-center w-full" style="background-color: #fef3c7; color: #92400e;">Próxima Devolución</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Trailer 004</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Ana Martínez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">2025-12-05</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-4 py-2 text-sm inline-block" style="background-color: #dcfce7; color: #166534;">Activa</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: Pagos Pendientes -->
        <div id="section-pagos" style="display:none;">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Pagos Pendientes</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bloque 1: Placeholder para gráficos -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="border-2 border-dashed border-slate-400 rounded-lg bg-slate-50 h-80 flex items-center justify-center text-slate-600 font-semibold">
                        Área para gráficos (barras, pastel, etc.)
                    </div>
                </div>

                <!-- Bloque 2: Tabla pagos pendientes -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md">
                    <div class="overflow-y-auto max-h-96">
                        <table class="w-full border-collapse">
                            <thead class="sticky top-0 bg-white">
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Cliente</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Concepto</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">Monto</th>
                                    <th class="px-4 py-3 text-center font-bold text-white text-base">Vencimiento</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Juan Pérez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Renta Trailer 001</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">$5,000.00</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">2025-11-20</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">María García</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Renta Trailer 002</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">$6,500.00</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">2025-11-28</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Carlos López</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Renta Trailer 003</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">$4,500.00</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">2025-11-23</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Ana Martínez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Curso B Transporte</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">$3,200.00</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">2025-12-01</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Roberto Sánchez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Mantenimiento Preventivo</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">$2,800.00</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">
                                        <span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fef3c7; color: #92400e;">2025-11-19</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchReportesTab(tab, el) {
            const secLecciones = document.getElementById('section-lecciones');
            const secRentas = document.getElementById('section-rentas');
            const secPagos = document.getElementById('section-pagos');

            secLecciones.style.display = (tab === 'lecciones') ? '' : 'none';
            secRentas.style.display = (tab === 'rentas') ? '' : 'none';
            secPagos.style.display = (tab === 'pagos') ? '' : 'none';

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
    </script>
</div>