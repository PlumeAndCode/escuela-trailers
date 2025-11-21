<div>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">GESTIÓN DE CONTROL</h1>
        </div>

        <!-- Botones de sección -->
        <div class="flex justify-center gap-4 mb-6 flex-wrap">
            <button class="text-white font-bold rounded-lg px-6 py-3 transition-all duration-300" 
                style="background-color: #FF7A00; box-shadow: 0 0 20px rgba(255, 122, 0, 0.6);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.6)'; this.style.transform='translateY(0)';"
                onclick="switchControlTab('avance', this)">
                Avance Alumno
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-3 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchControlTab('trailers', this)">
                Visualización Trailers
            </button>
            <button class="text-gray-900 font-bold rounded-lg px-6 py-3 transition-all duration-300" 
                style="background-color: #ffffff; box-shadow: 0 0 10px rgba(255, 122, 0, 0.4);"
                onmouseover="this.style.boxShadow='0 0 25px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0)';"
                onclick="switchControlTab('reportes', this)">
                Reportes Trailers
            </button>
        </div>

        <!-- TAB: Avance Alumno -->
        <div id="section-avance">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Avance del Alumno</h2>

            <!-- Controles superiores -->
            <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-2">
                    <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                    <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="font-semibold text-gray-900 text-base">registros:</label>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Filtrar Curso:</label>
                    <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-900 text-base font-medium">
                        <option value="">Todos los Cursos</option>
                        <option value="conduccion">Curso de Conducción A</option>
                        <option value="seguridad">Seguridad Vial</option>
                        <option value="remolques">Manejo de Remolques</option>
                        <option value="señalamientos">Señalamientos y Normativas</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                    <input type="text" 
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
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Nombre</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Curso</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Lecciones del Curso</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">Lecciones Tomadas</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300">% Completado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">001</td>
                                <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">Juan Pérez</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Curso de Conducción A</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">12</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">5</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-2">
                                        <div class="h-3 rounded-full transition-all duration-300" style="width: 42%; background-color: #10b981;"></div>
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm">42%</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">002</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">María López</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Seguridad Vial</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">8</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">8</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-2">
                                        <div class="h-3 rounded-full transition-all duration-300" style="width: 100%; background-color: #10b981;"></div>
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm">100%</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">003</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Carlos Reyes</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Manejo de Remolques</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">10</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">3</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-2">
                                        <div class="h-3 rounded-full transition-all duration-300" style="width: 30%; background-color: #10b981;"></div>
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm">30%</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">004</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Ana Torres</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Señalamientos y Normativas</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">9</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">6</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase">
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-2">
                                        <div class="h-3 rounded-full transition-all duration-300" style="width: 67%; background-color: #10b981;"></div>
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm">67%</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB: Visualización Trailers -->
        <div id="section-trailers" style="display:none;">
            
            <!-- Trailers Disponibles -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Trailers Disponibles</h2>
                
                <!-- Controles superiores -->
                <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center gap-2">
                        <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                        <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label class="font-semibold text-gray-900 text-base">registros:</label>
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                        <input type="text" 
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
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T001</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Wabash Dry Van</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">ABC-1234</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2022</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">25</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Remolque seco en excelente estado, sin daños</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T002</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Wabash Refrigerated</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">XYZ-5678</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2021</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">20</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Remolque refrigerado con sistema de enfriamiento activo</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T003</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Utility Flatbed</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">DEF-9012</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2023</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">30</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Plataforma plana para cargas variadas</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T004</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Stoughton Boxvan</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">GHI-3456</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2020</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">22</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Caja cerrada para protección de carga</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T005</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Hyster Lowboy</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">JKL-7890</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2019</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">35</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Remolque bajío para cargas pesadas</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T006</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Wabash Tanker</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">MNO-2345</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2022</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">28</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Cisterna para transporte de líquidos</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #dcfce7; color: #166534;">Disponible</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Trailers Rentados -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Trailers Rentados</h2>
                
                <!-- Controles superiores -->
                <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center gap-2">
                        <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                        <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                            <option value="10">10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label class="font-semibold text-gray-900 text-base">registros:</label>
                    </div>

                    <div class="flex items-center gap-3 flex-wrap">
                        <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                        <input type="text" 
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
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Fecha Devolución Estimada</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase border-r border-gray-300 sticky top-0">Notas</th>
                                <th class="px-4 py-3 text-center font-bold text-white textbase sticky top-0">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T007</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Great Dane Dry Van</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">PQR-6789</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Juan García</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">15/11/2024</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">22/11/2024</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Transporte de mercancía general, cliente confiable</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T008</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Vanguard Refrigerated</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">STU-0123</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">María Rodríguez</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">10/11/2024</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">25/11/2024</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Productos perecederos, requiere mantener temperatura</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T009</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Utilities Flatbed</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">VWX-4567</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Carlos López</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">01/11/2024</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">01/12/2024</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Materiales de construcción, renta de 30 días</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T010</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Wabash Tanker</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">YZA-8901</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Roberto Fernández</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">12/11/2024</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">19/11/2024</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Productos químicos, requiere documentación especial</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T011</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Stoughton Boxvan</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">BCD-5432</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Ana Martínez</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">18/11/2024</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">23/11/2024</td>
                                <td class="px-4 py-3 text-left text-gray-800 textbase border-r border-gray-300 max-w-xs">Paquetes y envíos, entrega dentro de 5 días</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fee2e2; color: #991b1b;">Rentado</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB: Reportes de Uso y Mantenimiento de Tráilers -->
        <div id="section-reportes" style="display:none;">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Reportes de Uso y Mantenimiento de Tráilers</h2>

            <!-- Controles superiores -->
            <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-2">
                    <label class="font-semibold text-gray-900 text-base">Mostrar</label>
                    <select class="border-2 border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-20 bg-white text-gray-900 text-base font-medium">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="font-semibold text-gray-900 text-base">registros:</label>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <label class="font-semibold whitespace-nowrap text-gray-900 text-base">Buscar:</label>
                    <input type="text" 
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
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T012</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Wabash Dry Van</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">ABC-1234</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2021</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fed7aa; color: #92400e;">En Mantenimiento</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">
                                    <button class="text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                        style="background-color: #2563EB;"
                                        onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                        onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                        onclick="openReportesModal('T012', 'Wabash Dry Van', 'ABC-1234')">
                                        5
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T013</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Utility Flatbed</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">DEF-5678</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2020</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fed7aa; color: #92400e;">En Mantenimiento</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">
                                    <button class="text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                        style="background-color: #2563EB;"
                                        onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                        onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                        onclick="openReportesModal('T013', 'Utility Flatbed', 'DEF-5678')">
                                        3
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T014</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Stoughton Boxvan</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">GHI-9012</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2019</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fed7aa; color: #92400e;">En Mantenimiento</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">
                                    <button class="text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                        style="background-color: #2563EB;"
                                        onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                        onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                        onclick="openReportesModal('T014', 'Stoughton Boxvan', 'GHI-9012')">
                                        7
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">#T015</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">Wabash Tanker</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">JKL-3456</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">2022</td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300"><span class="font-semibold rounded px-3 py-1 text-sm" style="background-color: #fed7aa; color: #92400e;">En Mantenimiento</span></td>
                                <td class="px-4 py-3 text-center text-gray-800 textbase border-r border-gray-300">
                                    <button class="text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                        style="background-color: #2563EB;"
                                        onmouseover="this.style.boxShadow='0 0 20px rgba(37, 99, 235, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                        onmouseout="this.style.boxShadow='0 0 10px rgba(37, 99, 235, 0.4)'; this.style.transform='translateY(0) scale(1)';"
                                        onclick="openReportesModal('T015', 'Wabash Tanker', 'JKL-3456')">
                                        2
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
                                        <td class="px-4 py-3 text-gray-800 text-base">12/11/2024</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Cambio de Aceite</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Cambio de aceite y filtro</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Carlos López</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-gray-800 text-base">08/11/2024</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Reparación de Neumáticos</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Reparación y reemplazo de neumático trasero</td>
                                        <td class="px-4 py-3 text-gray-800 textbase">Miguel Sánchez</td>
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
                                    <option>Reparación de Neumáticos</option>
                                    <option>Cambio de Filtro</option>
                                    <option>Mantenimiento de Suspensión</option>
                                    <option>Otro</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Descripción del Trabajo</label>
                                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 resize-none" rows="4" placeholder="Describe el trabajo realizado..."></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Técnico Responsable</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Nombre del técnico">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Fecha del Mantenimiento</label>
                                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div class="flex gap-4 mt-6">
                                <button class="flex-1 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                    style="background-color: #10b981;"
                                    onmouseover="this.style.backgroundColor='#059669';"
                                    onmouseout="this.style.backgroundColor='#10b981';">
                                    Guardar Reporte
                                </button>
                                <button onclick="closeReportesModal()" class="flex-1 text-gray-900 font-bold rounded-lg px-4 py-2 transition-all duration-300 bg-gray-200 hover:bg-gray-300">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <td class="px-4 py-3 text-gray-800 text-base">12/11/2024</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Cambio de Aceite</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Cambio de aceite y filtro</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Carlos López</td>
                                </tr>
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 text-gray-800 text-base">08/11/2024</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Reparación de Neumáticos</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Reparación y reemplazo de neumático trasero</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Miguel Sánchez</td>
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
                                <option>Reparación de Neumáticos</option>
                                <option>Cambio de Filtro</option>
                                <option>Mantenimiento de Suspensión</option>
                                <option>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Descripción del Trabajo</label>
                            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 resize-none" rows="4" placeholder="Describe el trabajo realizado..."></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Técnico Responsable</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Nombre del técnico">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Fecha del Mantenimiento</label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button class="flex-1 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                style="background-color: #10b981;"
                                onmouseover="this.style.backgroundColor='#059669';"
                                onmouseout="this.style.backgroundColor='#10b981';">
                                Guardar Reporte
                            </button>
                            <button onclick="closeReportesModal()" class="flex-1 text-gray-900 font-bold rounded-lg px-4 py-2 transition-all duration-300 bg-gray-200 hover:bg-gray-300">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <td class="px-4 py-3 text-gray-800 text-base">12/11/2024</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Cambio de Aceite</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Cambio de aceite y filtro</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Carlos López</td>
                                </tr>
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 text-gray-800 text-base">08/11/2024</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Reparación de Neumáticos</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Reparación y reemplazo de neumático trasero</td>
                                    <td class="px-4 py-3 text-gray-800 textbase">Miguel Sánchez</td>
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
                                <option>Reparación de Neumáticos</option>
                                <option>Cambio de Filtro</option>
                                <option>Mantenimiento de Suspensión</option>
                                <option>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Descripción del Trabajo</label>
                            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 resize-none" rows="4" placeholder="Describe el trabajo realizado..."></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Técnico Responsable</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Nombre del técnico">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Fecha del Mantenimiento</label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button class="flex-1 text-white font-bold rounded-lg px-4 py-2 transition-all duration-300" 
                                style="background-color: #10b981;"
                                onmouseover="this.style.backgroundColor='#059669';"
                                onmouseout="this.style.backgroundColor='#10b981';">
                                Guardar Reporte
                            </button>
                            <button onclick="closeReportesModal()" class="flex-1 text-gray-900 font-bold rounded-lg px-4 py-2 transition-all duration-300 bg-gray-200 hover:bg-gray-300">
                                Cancelar
                            </button>
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

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('reportesModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReportesModal();
            }
        });
    </script>
</div>