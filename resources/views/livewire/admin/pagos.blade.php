<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Pagos</h2>
        <input wire:model.debounce.300ms="search" 
               type="text" 
               placeholder="Buscar pagos..." 
               class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if($pagos->isEmpty())
            <div class="p-6 text-center text-gray-600">
                <p class="mb-2">No hay pagos registrados.</p>
        @else
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 text-left font-semibold">Número Transacción</th>
                        <th class="p-4 text-left font-semibold">Usuario</th>
                        <th class="p-4 text-left font-semibold">Monto</th>
                        <th class="p-4 text-left font-semibold">Estado</th>
                        <th class="p-4 text-left font-semibold">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagos as $p)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $p->numero_transaccion }}</td>
                            <td class="p-4">{{ $p->usuario ?? '-' }}</td>
                            <td class="p-4">{{ $p->monto ?? '-' }}</td>
                            <td class="p-4">{{ $p->estado ?? '-' }}</td>
                            <td class="p-4">{{ $p->fecha ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 px-4">
                {{ $pagos->links() }}
            </div>
        @endif
    </div>
</div>