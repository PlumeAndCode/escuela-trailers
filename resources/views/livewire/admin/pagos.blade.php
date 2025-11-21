<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="py-2 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE PAGOS</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button class="text-white font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                onclick="switchPagosTab('todos', this)">
                Todos los Pagos
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchPagosTab('ganancias', this)">
                Ganancias por Servicio
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-2 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchPagosTab('mensual', this)">
                Ganancias Mensuales
            </button>
        </div>

        <!-- TAB: Todos los Pagos -->
        <div id="section-todos">
            <!-- Controles superiores -->
            <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-2">
                    <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                    <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 w-20 bg-white text-gray-900 text-base font-medium">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="font-semibold text-gray-900 text-base">registros:</label>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Filtrar Estado:</label>
                    <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium">
                        <option value="">Todos</option>
                        <option value="pagado">Pagados</option>
                        <option value="pendiente">Pendientes</option>
                        <option value="vencido">Vencidos</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                    <input type="text" 
                        placeholder="Buscar por ID o usuario..." 
                        class="px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 placeholder-gray-400 text-base w-80">
                </div>
            </div>

            <!-- Tabla de pagos -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr style="background-color: #1b3346;">
                                <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-300">ID Pago</th>
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
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">#0001</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Juan Pérez López</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso A1 Licencia</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$450.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Tarjeta</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-emerald-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pagado</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">15/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0001', 'Juan Pérez López', 'Curso A1 Licencia', '450.00', 'Tarjeta', 'pagado', '15/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0002</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">María García Rodríguez</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso B Transporte</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$650.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Efectivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-emerald-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pagado</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">14/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0002', 'María García Rodríguez', 'Curso B Transporte', '650.00', 'Efectivo', 'pagado', '14/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0003</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Carlos Martínez Díaz</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Certificación Remolques</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$550.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Línea</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-orange-500 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pendiente</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">20/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0003', 'Carlos Martínez Díaz', 'Certificación Remolques', '550.00', 'Línea', 'pendiente', '20/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0004</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Ana López Fernández</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Mantenimiento Preventivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$300.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Tarjeta</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-red-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Vencido</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">10/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0004', 'Ana López Fernández', 'Mantenimiento Preventivo', '300.00', 'Tarjeta', 'vencido', '10/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0005</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Roberto Sánchez Gómez</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Capacitación Avanzada</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$400.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Efectivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-emerald-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pagado</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">13/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0005', 'Roberto Sánchez Gómez', 'Capacitación Avanzada', '400.00', 'Efectivo', 'pagado', '13/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0006</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Laura Jiménez Ruiz</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso A1 Licencia</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$450.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Tarjeta</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-orange-500 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pendiente</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">25/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0006', 'Laura Jiménez Ruiz', 'Curso A1 Licencia', '450.00', 'Tarjeta', 'pendiente', '25/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0007</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">José Luis Moreno Torres</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso B Transporte</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$650.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Línea</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-emerald-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pagado</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">12/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0007', 'José Luis Moreno Torres', 'Curso B Transporte', '650.00', 'Línea', 'pagado', '12/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0008</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Elena Rodríguez Castro</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Certificación Remolques</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$550.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Efectivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-red-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Vencido</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">05/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0008', 'Elena Rodríguez Castro', 'Certificación Remolques', '550.00', 'Efectivo', 'vencido', '05/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0009</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Miguel Hernández López</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Mantenimiento Preventivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$300.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Tarjeta</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-emerald-600 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pagado</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">16/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0009', 'Miguel Hernández López', 'Mantenimiento Preventivo', '300.00', 'Tarjeta', 'pagado', '16/11/2024')">Editar</button></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#0010</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Patricia Gómez Velasco</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Capacitación Avanzada</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$400.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Línea</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="bg-orange-500 text-white font-bold rounded px-4 py-2 inline-block text-sm">Pendiente</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">22/11/2024</td>
                                <td class="px-4 py-3 text-center"><button class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" style="background-color: #2563EB;" onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';" onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';" onclick="abrirModalPago('0010', 'Patricia Gómez Velasco', 'Capacitación Avanzada', '400.00', 'Línea', 'pendiente', '22/11/2024')">Editar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB: Ganancias por Servicio -->
        <div id="section-ganancias" style="display:none;">
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
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso A1 Licencia</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$12,450.50</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">28</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso B Transporte</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$18,750.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">29</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Certificación Remolques</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$15,200.75</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">28</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Mantenimiento Preventivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$8,900.25</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">30</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Capacitación Avanzada</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$5,600.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">14</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 p-6 bg-gradient-to-r from-gray-200 to-gray-300 rounded-lg text-right">
                <p class="text-gray-600 text-sm font-medium mb-2">Total de Ganancias</p>
                <p class="text-4xl font-bold text-gray-900">$60,901.50</p>
            </div>
        </div>

        <!-- TAB: Ganancias Mensuales -->
        <div id="section-mensual" style="display:none;">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Ganancias Mensuales</h2>

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <!-- Selector de Meses -->
                    <div class="flex items-center gap-4">
                        <label class="font-bold text-gray-900 text-base whitespace-nowrap">Seleccionar Mes:</label>
                        <select id="mesSelector" class="border-2 border-gray-300 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white text-gray-900 text-base font-medium flex-1" onchange="actualizarMes()">
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11" selected>Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>

                    <!-- Total del Mes -->
                    <div class="flex items-center gap-3 bg-gradient-to-r from-orange-100 to-orange-50 rounded-lg border-2 border-orange-300 px-6 py-3">
                        <p class="text-gray-900 font-bold text-base whitespace-nowrap">Total del Mes:</p>
                        <p class="text-gray-900 font-bold text-xl" id="totalMensual">$8,800.50</p>
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
                        <tbody class="bg-white" id="tablaMensualBody">
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso A1 Licencia</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$2,150.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">5</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso B Transporte</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$3,200.50</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">5</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Certificación Remolques</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$1,875.25</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">4</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Mantenimiento Preventivo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$950.00</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">3</td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Capacitación Avanzada</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">$625.75</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar pago -->
    <div id="modalPago" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="text-white px-8 py-6 sticky top-0 z-10" style="background-color: #1b3346;">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Editar Pago</h2>
                    <button class="text-white text-3xl hover:text-gray-300 transition" onclick="cerrarModalPago()">✕</button>
                </div>
            </div>

            <form id="formPago" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Columna Izquierda -->
                    <div>
                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">ID Pago</p>
                            <p class="text-gray-900 text-lg font-bold" id="infoPagoId">#0001</p>
                        </div>

                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Usuario</p>
                            <p class="text-gray-900 text-lg font-bold" id="infoPagoUsuario">Juan Pérez López</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Tipo de Pago</label>
                            <select id="editarTipoPago" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Línea">Línea</option>
                            </select>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div>
                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Servicio</p>
                            <p class="text-gray-900 text-lg font-bold" id="infoPagoServicio">Curso A1 Licencia</p>
                        </div>

                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Monto</p>
                            <p class="text-gray-900 text-lg font-bold" id="infoPagoMonto">$450.00</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Estado del Pago</label>
                            <select id="editarEstado" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
                                <option value="pagado">Pagado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="vencido">Vencido</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm">Fecha de Pago</label>
                        <input type="date" id="editarFecha" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm">Nota</label>
                        <input type="text" id="editarNota" placeholder="Agregar una nota (opcional)" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-gray-900 text-sm bg-white">
                    </div>
                </div>

                <div class="flex gap-4 justify-end pt-6 border-t-2 border-gray-200">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" onclick="cerrarModalPago()">
                        Cancelar
                    </button>
                    <button type="submit" class="text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 text-sm" 
                        style="background-color: #FF7A00;"
                        onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                        onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchPagosTab(tab, el) {
            const secTodos = document.getElementById('section-todos');
            const secGanancias = document.getElementById('section-ganancias');
            const secMensual = document.getElementById('section-mensual');

            secTodos.style.display = (tab === 'todos') ? '' : 'none';
            secGanancias.style.display = (tab === 'ganancias') ? '' : 'none';
            secMensual.style.display = (tab === 'mensual') ? '' : 'none';

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

        function abrirModalPago(id, usuario, servicio, monto, tipoPago, estado, fecha) {
            document.getElementById('infoPagoId').textContent = '#' + id;
            document.getElementById('infoPagoUsuario').textContent = usuario;
            document.getElementById('infoPagoServicio').textContent = servicio;
            document.getElementById('infoPagoMonto').textContent = '$' + parseFloat(monto).toFixed(2);
            
            document.getElementById('editarTipoPago').value = tipoPago;
            document.getElementById('editarEstado').value = estado;
            document.getElementById('editarFecha').value = convertirFecha(fecha);
            document.getElementById('editarNota').value = '';

            document.getElementById('modalPago').classList.remove('hidden');
        }

        function cerrarModalPago() {
            document.getElementById('modalPago').classList.add('hidden');
        }

        function convertirFecha(fechaString) {
            const partes = fechaString.split('/');
            return partes[2] + '-' + partes[1] + '-' + partes[0];
        }

        document.getElementById('formPago').addEventListener('submit', function(e) {
            e.preventDefault();
            const tipoPago = document.getElementById('editarTipoPago').value;
            const estado = document.getElementById('editarEstado').value;
            const fecha = document.getElementById('editarFecha').value;
            const nota = document.getElementById('editarNota').value;

            alert('Cambios guardados exitosamente!\n\nTipo de Pago: ' + tipoPago + '\nEstado: ' + estado + '\nFecha: ' + fecha + '\nNota: ' + (nota || 'Sin nota'));
            cerrarModalPago();
        });

        document.getElementById('modalPago').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModalPago();
            }
        });

        function actualizarMes() {
            const mesSelector = document.getElementById('mesSelector');
            const mesSeleccionado = mesSelector.value;
            
            const datosXMes = {
                '01': { total: '$8,800.50', servicios: [
                    ['Curso A1 Licencia', '$2,150.00', '5'],
                    ['Curso B Transporte', '$3,200.50', '5'],
                    ['Certificación Remolques', '$1,875.25', '4'],
                    ['Mantenimiento Preventivo', '$950.00', '3'],
                    ['Capacitación Avanzada', '$625.75', '2']
                ]},
                '02': { total: '$7,500.00', servicios: [
                    ['Curso A1 Licencia', '$1,850.00', '4'],
                    ['Curso B Transporte', '$2,800.00', '5'],
                    ['Certificación Remolques', '$1,550.00', '3'],
                    ['Mantenimiento Preventivo', '$850.00', '3'],
                    ['Capacitación Avanzada', '$450.00', '1']
                ]},
                '03': { total: '$9,200.75', servicios: [
                    ['Curso A1 Licencia', '$2,500.00', '6'],
                    ['Curso B Transporte', '$3,600.50', '6'],
                    ['Certificación Remolques', '$2,100.25', '4'],
                    ['Mantenimiento Preventivo', '$850.00', '3'],
                    ['Capacitación Avanzada', '$150.00', '1']
                ]},
                '04': { total: '$6,300.00', servicios: [
                    ['Curso A1 Licencia', '$1,500.00', '3'],
                    ['Curso B Transporte', '$2,100.00', '4'],
                    ['Certificación Remolques', '$1,200.00', '2'],
                    ['Mantenimiento Preventivo', '$350.00', '1'],
                    ['Capacitación Avanzada', '$1,150.00', '3']
                ]},
                '05': { total: '$10,100.25', servicios: [
                    ['Curso A1 Licencia', '$2,800.00', '6'],
                    ['Curso B Transporte', '$4,100.50', '7'],
                    ['Certificación Remolques', '$2,200.25', '4'],
                    ['Mantenimiento Preventivo', '$700.00', '2'],
                    ['Capacitación Avanzada', '$300.50', '1']
                ]},
                '06': { total: '$7,800.00', servicios: [
                    ['Curso A1 Licencia', '$1,900.00', '4'],
                    ['Curso B Transporte', '$2,900.00', '5'],
                    ['Certificación Remolques', '$1,700.00', '3'],
                    ['Mantenimiento Preventivo', '$900.00', '3'],
                    ['Capacitación Avanzada', '$400.00', '1']
                ]},
                '07': { total: '$11,500.50', servicios: [
                    ['Curso A1 Licencia', '$3,200.00', '7'],
                    ['Curso B Transporte', '$4,600.50', '8'],
                    ['Certificación Remolques', '$2,400.00', '4'],
                    ['Mantenimiento Preventivo', '$900.00', '3'],
                    ['Capacitación Avanzada', '$400.00', '1']
                ]},
                '08': { total: '$8,950.75', servicios: [
                    ['Curso A1 Licencia', '$2,100.00', '5'],
                    ['Curso B Transporte', '$3,200.50', '5'],
                    ['Certificación Remolques', '$2,050.25', '4'],
                    ['Mantenimiento Preventivo', '$900.00', '3'],
                    ['Capacitación Avanzada', '$700.00', '2']
                ]},
                '09': { total: '$9,600.00', servicios: [
                    ['Curso A1 Licencia', '$2,400.00', '5'],
                    ['Curso B Transporte', '$3,500.00', '6'],
                    ['Certificación Remolques', '$2,200.00', '4'],
                    ['Mantenimiento Preventivo', '$950.00', '3'],
                    ['Capacitación Avanzada', '$550.00', '1']
                ]},
                '10': { total: '$10,200.25', servicios: [
                    ['Curso A1 Licencia', '$2,700.00', '6'],
                    ['Curso B Transporte', '$3,800.50', '6'],
                    ['Certificación Remolques', '$2,300.25', '4'],
                    ['Mantenimiento Preventivo', '$850.00', '3'],
                    ['Capacitación Avanzada', '$550.50', '1']
                ]},
                '11': { total: '$8,800.50', servicios: [
                    ['Curso A1 Licencia', '$2,150.00', '5'],
                    ['Curso B Transporte', '$3,200.50', '5'],
                    ['Certificación Remolques', '$1,875.25', '4'],
                    ['Mantenimiento Preventivo', '$950.00', '3'],
                    ['Capacitación Avanzada', '$625.75', '2']
                ]},
                '12': { total: '$12,800.00', servicios: [
                    ['Curso A1 Licencia', '$3,500.00', '8'],
                    ['Curso B Transporte', '$4,800.00', '8'],
                    ['Certificación Remolques', '$2,700.00', '5'],
                    ['Mantenimiento Preventivo', '$1,000.00', '3'],
                    ['Capacitación Avanzada', '$800.00', '2']
                ]}
            };

            const datos = datosXMes[mesSeleccionado];
            document.getElementById('totalMensual').textContent = datos.total;

            const tabla = document.getElementById('tablaMensualBody');
            tabla.innerHTML = '';
            datos.servicios.forEach(([servicio, ganancia, numPagos]) => {
                const fila = `<tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">${servicio}</td>
                    <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">${ganancia}</td>
                    <td class="px-4 py-3 text-center text-gray-800 textbase">${numPagos}</td>
                </tr>`;
                tabla.innerHTML += fila;
            });
        }
    </script>
</div>