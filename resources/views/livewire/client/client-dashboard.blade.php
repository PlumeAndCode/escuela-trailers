<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">DriveMaster Pro</h1>
        <h2 class="text-xl text-gray-600 mt-2">CLIENTE</h2>
    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Bienvenido, {{ auth()->user()->name ?? 'Cliente' }}</h3>
        <p class="text-gray-600">Aquí puedes gestionar tus servicios, ver tu progreso y realizar pagos.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-amber-800 mb-2">Servicios Activos</h4>
            <p class="text-2xl font-bold text-amber-600">2</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-green-800 mb-2">Lecciones Completadas</h4>
            <p class="text-2xl font-bold text-green-600">40%</p>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-blue-800 mb-2">Próximo Pago</h4>
            <p class="text-2xl font-bold text-blue-600">17/10/2025</p>
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