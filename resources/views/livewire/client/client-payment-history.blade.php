<div>
    <!-- Contenido principal -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">DriveMaster Pro</h1>
            <h2 class="text-xl text-gray-600 mt-2">CLIENTE</h2>
        </div>

        <!-- Page Title -->
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-800">HISTORIAL DE PAGO</h3>
        </div>

        <!-- Payment Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-fixed">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="w-[10%] py-4 px-6 text-center font-semibold">SERVICIO</th>
                            <th class="w-[25%] py-4 px-6 text-center font-semibold">DESCRIPCIÓN</th>
                            <th class="w-[15%] py-4 px-6 text-center font-semibold">FECHA</th>
                            <th class="w-[15%] py-4 px-6 text-center font-semibold">MONTO</th>
                            <th class="w-[15%] py-4 px-6 text-center font-semibold">ACCIONES</th>
                            <th class="w-[15%] py-4 px-6 text-center font-semibold">ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Paid Service -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 text-center font-semibold text-gray-800">001</td>
                            <td class="py-4 px-6 text-center text-gray-700">Clase de Conducción</td>
                            <td class="py-4 px-6 text-center text-gray-700">17/09/2025</td>
                            <td class="py-4 px-6 text-center font-medium text-gray-800">$250.00</td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-amber-600 hover:text-amber-800 font-semibold inline-flex items-center justify-center transition-colors">
                                    <i class="fas fa-download mr-2"></i>
                                    Descargar
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Pagado
                                </span>
                            </td>
                        </tr>
                        
                        <!-- Pending Payment -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 text-center font-semibold text-gray-800">002</td>
                            <td class="py-4 px-6 text-center text-gray-700">Lección 1: Introducción</td>
                            <td class="py-4 px-6 text-center text-gray-700">20/06/2025</td>
                            <td class="py-4 px-6 text-center font-medium text-gray-800">$250.00</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center">
                                <button wire:click="openPaymentModal('Lección 1: Introducción', 250)" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors duration-200">
                                    Pagar
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Empty Rows -->
                        <tr class="border-b border-gray-200">
                            <td class="py-4 px-6 text-center text-gray-400">003</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-4 px-6 text-center text-gray-400">004</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="py-4 px-6 text-center text-gray-400">005</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                            <td class="py-4 px-6 text-center text-gray-400">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
            <p class="text-amber-800 text-sm">
                💡 <strong>Nota:</strong> Puedes descargar tus comprobantes en PDF y realizar pagos pendientes directamente desde esta sección.
            </p>
        </div>
    </div>

    <!-- Payment Modal -->
    @if($showPaymentModal)
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-5">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 max-w-md w-full relative shadow-2xl border border-gray-100">
            <!-- Close Button -->
            <button wire:click="closePaymentModal" class="absolute right-5 top-4 text-2xl text-gray-600 hover:text-amber-600 transition-colors">
                &times;
            </button>
            
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <div class="w-16 h-16 bg-amber-500 text-white rounded-full flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-credit-card"></i>
                </div>
                
                <!-- Title -->
                <h2 class="text-gray-900 text-xl font-bold mb-6">Procesar Pago</h2>
                <p class="text-gray-600 text-center mb-6">{{ $currentService }} - ${{ number_format($currentPrice, 2) }}</p>
                
                <!-- Payment Form -->
                <div class="w-full space-y-4">
                    <!-- Cardholder Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre en la tarjeta</label>
                        <input 
                            type="text" 
                            placeholder="JUAN PEREZ GARCIA"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                        >
                    </div>

                    <!-- Card Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Número de tarjeta</label>
                        <input 
                            type="text" 
                            placeholder="1234 5678 9012 3456"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                        >
                    </div>

                    <!-- Expiry and CVV -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha exp.</label>
                            <input 
                                type="text" 
                                placeholder="MM/AA"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                            <input 
                                type="text" 
                                placeholder="123"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                            >
                        </div>
                    </div>

                    <!-- Email for receipt -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email para recibo</label>
                        <input 
                            type="email" 
                            placeholder="tu@email.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button 
                        wire:click="processPayment" 
                        class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:shadow-xl hover:shadow-amber-500/50 transition-all mt-4"
                    >
                        <i class="fas fa-lock mr-2"></i>
                        Pagar ${{ number_format($currentPrice, 2) }}
                    </button>

                    <!-- Security Note -->
                    <p class="text-xs text-gray-500 text-center mt-4">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Tu pago está protegido con encriptación SSL
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Success Modal -->
    @if($showSuccessModal)
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-5">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 max-w-md w-full relative shadow-2xl border border-gray-100">
            <div class="flex flex-col items-center text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center text-3xl mb-4">
                    <i class="fas fa-check"></i>
                </div>
                
                <!-- Title -->
                <h2 class="text-gray-900 text-2xl font-bold mb-2">¡Pago Exitoso!</h2>
                <p class="text-gray-600 mb-6">Tu pago ha sido procesado correctamente.</p>

                <!-- Payment Details -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 w-full mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700">Servicio:</span>
                        <span class="font-semibold">{{ $currentService }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700">Monto:</span>
                        <span class="font-semibold">${{ number_format($currentPrice, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Referencia:</span>
                        <span class="font-semibold">PMT-{{ rand(1000,9999) }}</span>
                    </div>
                </div>

                <!-- Close Button -->
                <button 
                    wire:click="closeSuccessModal"
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/50 transition-all"
                >
                    Continuar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>