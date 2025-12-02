<div class="p-6 bg-gray-100 min-h-screen"
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
                <template x-if="toast.type === 'warning'">
                    <i class="fas fa-exclamation-triangle"></i>
                </template>
                <template x-if="toast.type === 'info'">
                    <i class="fas fa-info-circle"></i>
                </template>
                <span x-text="toast.message"></span>
                <button @click="removeToast(toast.id)" class="ml-2 hover:opacity-75">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </template>
    </div>

    <!-- Page Title -->
    <div class="pb-3 flex items-center justify-center mb-6">
        <h1 class="text-4xl font-bold text-gray-900">PANEL DE CLIENTE</h1>
    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenido, {{ auth()->user()->nombre_completo ?? 'Cliente' }}</h3>
        <p class="text-gray-600">Aquí puedes gestionar tus servicios, ver tu progreso y realizar pagos.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Servicios Activos</h4>
            <p class="text-3xl font-bold text-amber-600">{{ $serviciosActivos }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Lecciones Completadas</h4>
            <p class="text-3xl font-bold text-green-600">{{ $porcentajeAvance }}%</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Próximo Pago</h4>
            <p class="text-3xl font-bold text-blue-600">
                @if($proximoPago)
                    {{ $proximoPago->fecha_pago->format('d/m/Y') }}
                @else
                    <span class="text-base">Sin pagos pendientes</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
        <h4 class="text-xl font-bold text-gray-900 mb-4">Acciones Rápidas</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('client.payment-history') }}" 
                class="font-bold rounded text-white text-base py-3 px-4 text-center transition-all duration-300" 
                style="background-color: #FF7A00;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.02)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-credit-card mr-2"></i>
                Realizar Pago
            </a>
            <a href="{{ route('client.progress') }}" 
                class="font-bold rounded text-white text-base py-3 px-4 text-center transition-all duration-300" 
                style="background-color: #10b981;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(16, 185, 129, 0.8)'; this.style.transform='translateY(-2px) scale(1.02)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(16, 185, 129, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-chart-line mr-2"></i>
                Ver Mi Progreso
            </a>
        </div>
    </div>
</div>