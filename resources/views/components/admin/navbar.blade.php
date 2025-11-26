<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-5 flex justify-between items-center h-20">
        <!-- Logo -->
        <a href="@if(Route::is('admin.*')){{ route('admin.dashboard') }}@elseif(Route::is('manager.*')){{ route('manager.lecciones.index') }}@else{{ route('admin.dashboard') }}@endif" 
           class="text-3xl font-bold text-gray-900">
            Drive<span class="text-amber-500">Master</span> Pro
        </a>
    </nav>
</header>