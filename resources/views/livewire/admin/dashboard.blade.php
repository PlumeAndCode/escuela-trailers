<div>
    <h1 class="text-3xl font-bold mb-6">Panel del Administrador</h1>

    <p class="mb-4 text-gray-700">Bienvenido, <span class="font-semibold">{{ $user->nombre_completo ?? 'Administrador' }}</span>.</p>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-800">Este es el dashboard principal. Usa el menú lateral para acceder a los submódulos.</p>
        <p class="text-sm text-gray-500 mt-4">Actualmente la aplicación está en modo demo (sin base de datos).</p>
    </div>
</div>