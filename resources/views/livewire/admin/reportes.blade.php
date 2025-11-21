<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE REPORTES</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button class="text-white font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                onclick="switchReportesTab('servicios', this)">
                Servicios Mas Contratados
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchReportesTab('ingresos', this)">
                Ingresos por Servicio
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchReportesTab('clientes', this)">
                Clientes
            </button>
        </div>

        <!-- TAB: Servicios Más Contratados -->
        <div id="section-servicios">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Servicios Más Contratados</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bloque 1: Placeholder para gráficos -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="border-2 border-dashed border-slate-400 rounded-lg bg-slate-50 h-80 flex items-center justify-center text-slate-600 font-semibold">
                        Área para gráficos (barras, pastel, etc.)
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
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">1</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Curso A1 Licencia</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">248</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">2</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Curso B Transporte</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">193</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">3</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Certificación Remolques</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">151</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">4</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Mantenimiento Preventivo</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">112</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">5</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Capacitación Avanzada</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">74</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: Ingresos Por Servicio -->
        <div id="section-ingresos" style="display:none;">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Ingresos Por Servicio</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bloque 1: Placeholder para gráficos -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="border-2 border-dashed border-slate-400 rounded-lg bg-slate-50 h-80 flex items-center justify-center text-slate-600 font-semibold">
                        Área para gráficos (barras, pastel, etc.)
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
                                    <th class="px-4 py-3 text-center font-bold text-white text-base">Ingreso</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">1</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso B Transporte</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">$124,500.00</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">2</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Certificación Remolques</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">$98,200.00</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">3</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso A1 Licencia</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">$86,400.00</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">4</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Mantenimiento Preventivo</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">$52,750.00</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">5</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Capacitación Avanzada</td>
                                    <td class="px-4 py-3 text-center text-gray-800 textbase">$31,900.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: Clientes -->
        <div id="section-clientes" style="display:none;">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Clientes</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bloque 1: Placeholder para gráficos -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="border-2 border-dashed border-slate-400 rounded-lg bg-slate-50 h-80 flex items-center justify-center text-slate-600 font-semibold">
                        Área para gráficos (barras, pastel, etc.)
                    </div>
                </div>

                <!-- Bloque 2: Tabla de clientes -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md h-full">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr style="background-color: #1b3346;">
                                    <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">ID Cliente</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Nombre del Cliente</th>
                                    <th class="px-4 py-3 text-center font-bold text-white textbase">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">001</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Juan Pérez</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">Activo</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">002</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Ana López</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">Finalizado</td>
                                </tr>
                                <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">003</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Carlos Ruiz</td>
                                    <td class="px-4 py-3 text-center text-gray-800 text-base">Activo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón Descargar PDF -->
        <div class="mt-6 flex justify-end">
            <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg px-6 py-2 transition-all duration-300 text-base" 
                style="box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';">
                Descargar PDF
            </button>
        </div>
    </div>

    <script>
        function switchReportesTab(tab, el) {
            const secServicios = document.getElementById('section-servicios');
            const secIngresos = document.getElementById('section-ingresos');
            const secClientes = document.getElementById('section-clientes');

            secServicios.style.display = (tab === 'servicios') ? '' : 'none';
            secIngresos.style.display = (tab === 'ingresos') ? '' : 'none';
            secClientes.style.display = (tab === 'clientes') ? '' : 'none';

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