<div class="max-w-7xl mx-auto"
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

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">DriveMaster Pro</h1>
        <h2 class="text-xl text-gray-600 mt-2">CLIENTE</h2>
    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenido, {{ auth()->user()->nombre_completo ?? 'Cliente' }}</h3>
        <p class="text-gray-600">Aquí puedes gestionar tus servicios, ver tu progreso y realizar pagos.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-amber-800 mb-2">Servicios Activos</h4>
            <p class="text-2xl font-bold text-amber-600">{{ $serviciosActivos }}</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-green-800 mb-2">Lecciones Completadas</h4>
            <p class="text-2xl font-bold text-green-600">{{ $porcentajeAvance }}%</p>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-blue-800 mb-2">Próximo Pago</h4>
            <p class="text-2xl font-bold text-blue-600">
                @if($proximoPago)
                    {{ $proximoPago->fecha_pago->format('d/m/Y') }}
                @else
                    <span class="text-sm">Sin pagos pendientes</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h4 class="text-xl font-semibold text-gray-800 mb-4">Acciones Rápidas</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('client.payment-history') }}" class="bg-amber-500 hover:bg-amber-600 text-white py-3 px-4 rounded-lg text-center font-semibold transition-colors">
                Realizar Pago
            </a>
            <a href="{{ route('client.progress') }}" class="bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg text-center font-semibold transition-colors">
                Ver Mi Progreso
            </a>
        </div>
    </div>
</div>