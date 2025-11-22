<div>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">DriveMaster Pro</h1>
            <h2 class="text-xl text-gray-600 mt-2">CLIENTE</h2>
        </div>

        <!-- Page Title and Add Button -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Servicios contratados</h3>
                <p class="text-gray-600 mt-2">Aquí puedes ver tus servicios activos y próximos pagos o vencimientos</p>
            </div>
            <button onclick="openAddServiceModal()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Añadir Servicios
            </button>
        </div>

        <!-- Services Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <table class="w-full table-fixed">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="w-[8%] py-3 px-4 text-center font-semibold">ID</th>
                        <th class="w-[27%] py-3 px-4 text-center font-semibold">SERVICIO</th>
                        <th class="w-[15%] py-3 px-4 text-center font-semibold">FECHA INICIO</th>
                        <th class="w-[15%] py-3 px-4 text-center font-semibold">VENCIMIENTO</th>
                        <th class="w-[15%] py-3 px-4 text-center font-semibold">PRÓXIMO PAGO</th>
                        <th class="w-[20%] py-3 px-4 text-center font-semibold">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Service 1 -->
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-4 px-4 text-center font-semibold">001</td>
                        <td class="py-4 px-4 text-center">
                            <div class="font-semibold">Conductor Designado</div>
                            <div class="text-sm text-gray-600">Curso completo para obtener licencia</div>
                        </td>
                        <td class="py-4 px-4 text-center">17/09/2025</td>
                        <td class="py-4 px-4 text-center">17/10/2025</td>
                        <td class="py-4 px-4 text-center">
                            <span class="text-amber-600 font-semibold">-</span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <button class="text-red-600 hover:text-red-800 font-semibold text-sm">
                                Anular Servicio
                            </button>
                        </td>
                    </tr>

                    <!-- Service 2 -->
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-4 px-4 text-center font-semibold">002</td>
                        <td class="py-4 px-4 text-center">
                            <div class="font-semibold">Clase de Conducción</div>
                            <div class="text-sm text-gray-600">Lecciones individuales de manejo</div>
                        </td>
                        <td class="py-4 px-4 text-center">20/06/2025</td>
                        <td class="py-4 px-4 text-center">05/10/2025</td>
                        <td class="py-4 px-4 text-center">
                            <span class="text-amber-600 font-semibold">11/10/2025</span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <button class="text-red-600 hover:text-red-800 font-semibold text-sm">
                                Anular Servicio
                            </button>
                        </td>
                    </tr>

                    <!-- Empty Rows -->
                    @for($i = 3; $i <= 6; $i++)
                    <tr class="border-b border-gray-200">
                        <td class="py-4 px-4 text-center text-gray-400">00{{ $i }}</td>
                        <td class="py-4 px-4 text-center text-gray-400">-</td>
                        <td class="py-4 px-4 text-center text-gray-400">-</td>
                        <td class="py-4 px-4 text-center text-gray-400">-</td>
                        <td class="py-4 px-4 text-center text-gray-400">-</td>
                        <td class="py-4 px-4 text-center text-gray-400">-</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

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
    <div id="addServiceModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] items-center justify-center p-5">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 max-w-2xl w-full relative shadow-2xl border border-gray-100">
            <!-- Close Button -->
            <button onclick="closeAddServiceModal()" class="absolute right-5 top-4 text-2xl text-gray-600 hover:text-amber-600 transition-colors">
                &times;
            </button>
            
            <div class="flex flex-col">
                <!-- Title -->
                <h2 class="text-gray-900 text-2xl font-bold mb-6 text-center">Añadir Nuevo Servicio</h2>
                
                <!-- Services List -->
                <div class="space-y-4 max-h-96 overflow-y-auto mb-6">
                    <!-- Service 1 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:border-amber-300 transition-all">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-gray-800">Lección 3: Manejo Defensivo</h4>
                                <p class="text-gray-600 text-sm mt-1">Técnicas de conducción preventiva y seguridad vial</p>
                                <p class="text-amber-600 font-bold mt-2">$300.00</p>
                            </div>
                            <button onclick="selectService('Lección 3: Manejo Defensivo', 300)" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                                Seleccionar
                            </button>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:border-amber-300 transition-all">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-gray-800">Lección 4: Estacionamiento</h4>
                                <p class="text-gray-600 text-sm mt-1">Técnicas de estacionamiento en diferentes escenarios</p>
                                <p class="text-amber-600 font-bold mt-2">$280.00</p>
                            </div>
                            <button onclick="selectService('Lección 4: Estacionamiento', 280)" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                                Seleccionar
                            </button>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:border-amber-300 transition-all">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-gray-800">Renta de Tráiler - 4 horas</h4>
                                <p class="text-gray-600 text-sm mt-1">Práctica con vehículo pesado con instructor</p>
                                <p class="text-amber-600 font-bold mt-2">$500.00</p>
                            </div>
                            <button onclick="selectService('Renta de Tráiler - 4 horas', 500)" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                                Seleccionar
                            </button>
                        </div>
                    </div>

                    <!-- Service 4 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:border-amber-300 transition-all">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-gray-800">Trámite de Licencia</h4>
                                <p class="text-gray-600 text-sm mt-1">Gestión completa para obtención de licencia</p>
                                <p class="text-amber-600 font-bold mt-2">$150.00</p>
                            </div>
                            <button onclick="selectService('Trámite de Licencia', 150)" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                                Seleccionar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Selected Service -->
                <div id="selectedService" class="hidden bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                    <h4 class="font-semibold text-amber-800 mb-2">Servicio Seleccionado:</h4>
                    <div class="flex justify-between items-center">
                        <div>
                            <span id="serviceName" class="font-semibold"></span>
                            <span id="servicePrice" class="text-amber-600 font-bold ml-4"></span>
                        </div>
                        <button onclick="addToPayments()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                            Añadir a Pagos
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedService = null;
let selectedPrice = null;

function openAddServiceModal() {
    document.getElementById('addServiceModal').classList.remove('hidden');
    document.getElementById('addServiceModal').classList.add('flex');
}

function closeAddServiceModal() {
    document.getElementById('addServiceModal').classList.add('hidden');
    document.getElementById('addServiceModal').classList.remove('flex');
    resetSelection();
}

function selectService(serviceName, price) {
    selectedService = serviceName;
    selectedPrice = price;
    
    document.getElementById('serviceName').textContent = serviceName;
    document.getElementById('servicePrice').textContent = '$' + price.toFixed(2);
    document.getElementById('selectedService').classList.remove('hidden');
}

function resetSelection() {
    selectedService = null;
    selectedPrice = null;
    document.getElementById('selectedService').classList.add('hidden');
}

function addToPayments() {
    if (selectedService && selectedPrice) {
        closeAddServiceModal();
        
        const newService = {
            name: selectedService,
            price: selectedPrice,
            id: Date.now(),
            date: new Date().toLocaleDateString('es-MX')
        };
        
        sessionStorage.setItem('newService', JSON.stringify(newService));
        window.location.href = "{{ route('client.payment-history') }}";
    }
}

window.addEventListener('click', (e) => {
    const modal = document.getElementById('addServiceModal');
    if (e.target === modal) {
        closeAddServiceModal();
    }
});
</script>