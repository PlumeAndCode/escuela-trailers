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

    <!-- Contenido principal -->
    <div class="p-6 bg-gray-100 min-h-screen">
        <!-- Page Title -->
        <div class="pb-3 flex items-center justify-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900">Historial de Pago</h1>
        </div>

        <!-- Filters -->
        <div class="flex justify-between items-center mb-6 gap-4 flex-wrap bg-white p-4 rounded-lg shadow-md">
            <div class="flex items-center gap-2">
                <label class="font-semibold text-gray-900 text-base whitespace-nowrap">Buscar:</label>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Buscar por servicio..."
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
                    <option value="pendiente">Pendientes</option>
                    <option value="pagado">Pagados</option>
                    <option value="vencido">Vencidos</option>
                </select>
            </div>
        </div>

        <!-- Payment Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr style="background-color: #1b3346;">
                            <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">#</th>
                            <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Servicio</th>
                            <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Fecha</th>
                            <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Monto</th>
                            <th class="px-4 py-3 text-center font-bold text-white text-base border-r border-gray-600">Acciones</th>
                            <th class="px-4 py-3 text-center font-bold text-white text-base">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($pagos as $index => $pago)
                        @php
                            $estaVencido = $pago->estado_pago === 'pendiente' && $pago->fecha_pago < now();
                        @endphp
                        <tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $pago->contratacion->servicio->nombre_servicio ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center text-gray-800 text-base border-r border-gray-300">{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-center text-gray-800 text-base font-medium border-r border-gray-300">${{ number_format($pago->monto_pagado, 2) }}</td>
                            <td class="px-4 py-3 text-center border-r border-gray-300">
                                @if($pago->estado_pago === 'pagado')
                                    <button 
                                        wire:click="descargarComprobante('{{ $pago->id }}')"
                                        class="text-amber-600 hover:text-amber-800 font-semibold inline-flex items-center justify-center transition-colors"
                                    >
                                        <i class="fas fa-download mr-2"></i>
                                        Descargar
                                    </button>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($pago->estado_pago === 'pagado')
                                    <span class="font-semibold rounded px-4 py-2 text-sm" style="background-color: #10b981; color: #ffffff;">
                                        Pagado
                                    </span>
                                @elseif($estaVencido || $pago->estado_pago === 'vencido')
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="font-semibold rounded px-4 py-2 text-sm" style="background-color: #ef4444; color: #ffffff;">
                                            Vencido
                                        </span>
                                        <button 
                                            wire:click="openPaymentModal('{{ $pago->id }}')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition-colors duration-200"
                                        >
                                            Pagar Ahora
                                        </button>
                                    </div>
                                @else
                                    <button 
                                        wire:click="openPaymentModal('{{ $pago->id }}')"
                                        class="font-bold rounded text-white text-sm py-2 px-5 transition-all duration-300" 
                                        style="background-color: #FF7A00;"
                                        onmouseover="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.05)';"
                                        onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                                        Pagar
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center bg-white">
                                <i class="fas fa-receipt text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-base font-medium">No tienes pagos registrados</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($pagos->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $pagos->links() }}
        </div>
        @endif

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
                <form wire:submit.prevent="processPayment" class="w-full space-y-4">
                    <!-- Cardholder Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre en la tarjeta</label>
                        <input 
                            type="text" 
                            wire:model="cardName"
                            placeholder="JUAN PEREZ GARCIA"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all @error('cardName') border-red-500 @enderror"
                        >
                        @error('cardName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Card Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Número de tarjeta</label>
                        <input 
                            type="text" 
                            wire:model="cardNumber"
                            placeholder="1234 5678 9012 3456"
                            maxlength="19"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all @error('cardNumber') border-red-500 @enderror"
                        >
                        @error('cardNumber') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Expiry and CVV -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha exp.</label>
                            <input 
                                type="text" 
                                wire:model="cardExpiry"
                                placeholder="MM/AA"
                                maxlength="5"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all @error('cardExpiry') border-red-500 @enderror"
                            >
                            @error('cardExpiry') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                            <input 
                                type="text" 
                                wire:model="cardCvv"
                                placeholder="123"
                                maxlength="4"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all @error('cardCvv') border-red-500 @enderror"
                            >
                            @error('cardCvv') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Email for receipt -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email para recibo</label>
                        <input 
                            type="email" 
                            wire:model="emailRecibo"
                            placeholder="tu@email.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all @error('emailRecibo') border-red-500 @enderror"
                        >
                        @error('emailRecibo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:shadow-xl hover:shadow-amber-500/50 transition-all mt-4 disabled:opacity-50"
                    >
                        <span wire:loading.remove wire:target="processPayment">
                            <i class="fas fa-lock mr-2"></i>
                            Pagar ${{ number_format($currentPrice, 2) }}
                        </span>
                        <span wire:loading wire:target="processPayment">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Procesando...
                        </span>
                    </button>

                    <!-- Security Note -->
                    <p class="text-xs text-gray-500 text-center mt-4">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Tu pago está protegido con encriptación SSL
                    </p>
                </form>
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
                        <span class="font-semibold">{{ $referenciaPago }}</span>
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