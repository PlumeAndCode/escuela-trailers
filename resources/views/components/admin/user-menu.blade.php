@props(['user'])

<nav class="mt-8 flex flex-col h-[calc(100vh-400px)]">
    <ul class="space-y-3 flex-1">
        <li>
            <a href="{{ route('admin.users.index') }}" 
               class="menu-btn flex items-center justify-center px-4 py-3 rounded-lg font-bold text-white uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <span class="text-sm">Usuarios</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pagos.index') }}" 
               class="menu-btn flex items-center justify-center px-4 py-3 rounded-lg font-bold text-white uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('admin.pagos.index') ? 'active' : '' }}">
                <span class="text-sm">Pagos</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reportes.index') }}" 
               class="menu-btn flex items-center justify-center px-4 py-3 rounded-lg font-bold text-white uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('admin.reportes.index') ? 'active' : '' }}">
                <span class="text-sm">Reportes</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.control.index') }}" 
               class="menu-btn flex items-center justify-center px-4 py-3 rounded-lg font-bold text-white uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('admin.control.index') ? 'active' : '' }}">
                <span class="text-sm">Control</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto pb-4" style="margin-top: 150px;">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center px-4 py-3 rounded-lg font-bold text-white uppercase tracking-wider bg-red-500 hover:bg-red-600 transition-all hover:shadow-md hover:shadow-gray-500 hover:translate-y-1">
                <span class="text-sm">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</nav>

<style>
.menu-btn {
    background-color: #1F2937; 
    border: 2px solid transparent;
    box-shadow: none;
    transition: all 0.3s ease;
}

.menu-btn:hover {
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
}

.menu-btn.active {
    background-color: #1F2937 !important;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.6) !important;
    border: 1px solid rgba(255, 255, 255, 0.4);
}

.menu-btn.active span {
    color: #ffffff !important;
}
</style>
