<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Control</h2>
        <input wire:model.debounce.300ms="search" 
               type="text" 
               placeholder="Buscar controles..." 
               class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if($controles->isEmpty())
            <div class="p-6 text-center text-gray-600">
                <p class="mb-2">No hay registros de control.</p>
            </div>
        @else
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 text-left font-semibold">Nombre</th>
                        <th class="p-4 text-left font-semibold">Descripción</th>
                        <th class="p-4 text-left font-semibold">Estado</th>
                        <th class="p-4 text-left font-semibold">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($controles as $c)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $c->nombre }}</td>
                            <td class="p-4">{{ $c->descripcion ?? '-' }}</td>
                            <td class="p-4">{{ $c->estado ?? '-' }}</td>
                            <td class="p-4">{{ $c->fecha ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 px-4">
                {{ $controles->links() }}
            </div>
        @endif
    </div>
</div>