<div>
    <h1 class="text-3xl font-bold mb-6">Panel del Encargado</h1>

    <p class="mb-4 text-gray-700">Bienvenido, <span class="font-semibold">{{ auth()->user()->nombre_completo ?? 'Encargado' }}</span>.</p>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-gray-800">Este es el dashboard principal. Usa el menú lateral para acceder a los submódulos.</p>
    </div>
</div>