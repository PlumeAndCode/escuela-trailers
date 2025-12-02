<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Page Title -->
    <div class="pb-3 flex items-center justify-center mb-6">
        <h1 class="text-4xl font-bold text-gray-900">PANEL DE ADMINISTRADOR</h1>
    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenido, {{ $user->nombre_completo ?? 'Administrador' }}</h3>
        <p class="text-gray-600">Aquí puedes gestionar usuarios, pagos, reportes y el control del sistema.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Usuarios Totales</h4>
            <p class="text-3xl font-bold text-amber-600">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Pagos Pendientes</h4>
            <p class="text-3xl font-bold text-red-600">{{ \App\Models\Pago::where('estado_pago', 'pendiente')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Servicios Activos</h4>
            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Contratacion::where('estado_contratacion', 'activo')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-2">Trailers Disponibles</h4>
            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Trailer::where('estado_trailer', 'disponible')->count() }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
        <h4 class="text-xl font-bold text-gray-900 mb-4">Acciones Rápidas</h4>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.index') }}" 
                class="font-bold rounded text-white text-base py-3 px-4 text-center transition-all duration-300" 
                style="background-color: #FF7A00;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(255, 122, 0, 0.8)'; this.style.transform='translateY(-2px) scale(1.02)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(255, 122, 0, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-users mr-2"></i>
                Gestionar Usuarios
            </a>
            <a href="{{ route('admin.pagos.index') }}" 
                class="font-bold rounded text-white text-base py-3 px-4 text-center transition-all duration-300" 
                style="background-color: #10b981;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(16, 185, 129, 0.8)'; this.style.transform='translateY(-2px) scale(1.02)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(16, 185, 129, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-credit-card mr-2"></i>
                Ver Pagos
            </a>
            <a href="{{ route('admin.reportes.index') }}" 
                class="font-bold rounded text-white text-base py-3 px-4 text-center transition-all duration-300" 
                style="background-color: #3b82f6;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(59, 130, 246, 0.8)'; this.style.transform='translateY(-2px) scale(1.02)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(59, 130, 246, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-chart-bar mr-2"></i>
                Ver Reportes
            </a>
            <a href="{{ route('admin.control.index') }}" 
                class="font-bold rounded text-white text-base py-3 px-4 text-center transition-all duration-300" 
                style="background-color: #8b5cf6;"
                onmouseover="this.style.boxShadow='0 0 20px rgba(139, 92, 246, 0.8)'; this.style.transform='translateY(-2px) scale(1.02)';"
                onmouseout="this.style.boxShadow='0 0 10px rgba(139, 92, 246, 0.4)'; this.style.transform='translateY(0) scale(1)';">
                <i class="fas fa-cogs mr-2"></i>
                Control
            </a>
        </div>
    </div>
</div>