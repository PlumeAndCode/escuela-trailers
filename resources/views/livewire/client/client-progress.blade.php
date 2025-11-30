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

    <!-- Page Title -->
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-800">AVANCE Y PROGRAMA DE ESTUDIO</h3>
        <p class="text-gray-600 mt-2">Seguimiento de tu progreso en los cursos</p>
    </div>

    <!-- Filter by Course -->
    @if($cursos->count() > 1)
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="flex items-center gap-4">
            <label class="font-semibold text-gray-700">Filtrar por curso:</label>
            <select 
                wire:model.live="cursoSeleccionado"
                wire:change="filtrarPorCurso($event.target.value)"
                class="px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-amber-500"
            >
                <option value="">Todos los cursos</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre_curso }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <!-- Progress Bar -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-semibold text-gray-700">Progreso General</span>
            <span class="text-sm font-bold text-amber-600">{{ $porcentajeGeneral }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-amber-500 h-4 rounded-full transition-all duration-500" style="width: {{ $porcentajeGeneral }}%"></div>
        </div>
    </div>

    <!-- Lessons List -->
    <div class="space-y-4">
        @forelse($leccionesConEstado as $leccion)
        @php
            $borderColor = match($leccion['estado']) {
                'pagada' => 'border-green-500',
                'vista' => 'border-blue-500',
                'pendiente' => 'border-gray-300',
                default => 'border-gray-300'
            };
            $badgeClass = match($leccion['estado']) {
                'pagada' => 'bg-green-100 text-green-800',
                'vista' => 'bg-blue-100 text-blue-800',
                'pendiente' => 'bg-gray-100 text-gray-800',
                default => 'bg-gray-100 text-gray-800'
            };
            $estadoTexto = match($leccion['estado']) {
                'pagada' => 'Pagada',
                'vista' => 'Vista',
                'pendiente' => 'Pendiente',
                default => 'Pendiente'
            };
        @endphp
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 {{ $borderColor }}">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $leccion['nombre'] }}</h4>
                        @if($leccion['curso'])
                            <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded">{{ $leccion['curso'] }}</span>
                        @endif
                    </div>
                    <p class="text-gray-600 mt-1">{{ $leccion['descripcion'] ?? 'Sin descripción' }}</p>
                    @if($leccion['observaciones'])
                        <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                            <p class="text-sm text-amber-800">
                                <i class="fas fa-info-circle mr-1"></i>
                                <strong>Observaciones:</strong> {{ $leccion['observaciones'] }}
                            </p>
                        </div>
                    @endif
                </div>
                <span class="{{ $badgeClass }} px-3 py-1 rounded-full text-sm font-semibold whitespace-nowrap ml-4">
                    {{ $estadoTexto }}
                </span>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <i class="fas fa-book-open text-gray-300 text-5xl mb-4"></i>
            <p class="text-gray-500">No tienes lecciones asignadas aún</p>
            <a href="{{ route('client.services') }}" class="mt-4 inline-block text-amber-600 hover:text-amber-700 font-semibold">
                Ver servicios disponibles
            </a>
        </div>
        @endforelse

        <!-- Upcoming Lessons -->
        @if($proximasLecciones->count() > 0)
        <div class="bg-gray-50 rounded-lg p-6 mt-6">
            <h5 class="font-semibold text-gray-700 mb-3">
                <i class="fas fa-clock mr-2"></i>
                Próximas Lecciones:
            </h5>
            <ul class="space-y-2 text-gray-600">
                @foreach($proximasLecciones as $proxima)
                <li class="flex items-center">
                    <span class="text-amber-500 mr-2">•</span>
                    <span>{{ $proxima['nombre'] }}</span>
                    @if($proxima['curso'])
                        <span class="text-xs text-gray-400 ml-2">({{ $proxima['curso'] }})</span>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- Legend -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-4">
        <h5 class="font-semibold text-gray-700 mb-3">Leyenda de Estados:</h5>
        <div class="flex flex-wrap gap-4 text-sm">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                <span>Pagada - Lección completamente pagada</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                <span>Vista - Lección visualizada</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-gray-300 rounded mr-2"></div>
                <span>Pendiente - Por completar</span>
            </div>
        </div>
    </div>
</div>