<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-5 flex justify-between items-center h-20">
        <!-- Logo -->
        <div class="text-3xl font-bold text-gray-900">
            Drive<span class="text-amber-500">Master</span> Pro
        </div>
        
        <!-- Navigation Links -->
        <ul class="hidden md:flex gap-8 list-none">
            <li>
                <a href="{{ route('home') }}" class="text-gray-900 font-semibold hover:text-amber-500 transition-colors relative group">
                    Inicio
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="text-gray-900 font-semibold hover:text-amber-500 transition-colors relative group">
                    Servicios
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="text-gray-900 font-semibold hover:text-amber-500 transition-colors relative group">
                    Nosotros
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="text-gray-900 font-semibold hover:text-amber-500 transition-colors relative group">
                    Contacto
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-amber-500 transition-all group-hover:w-full"></span>
                </a>
            </li>
        </ul>
        
        <!-- Auth Buttons -->
        @auth
            <div class="flex items-center gap-4">
                <!-- Dashboard Link -->
                <a href="{{ auth()->user()->getDashboardPath() }}" class="text-gray-900 font-semibold hover:text-amber-500 transition-colors">
                    {{ auth()->user()->nombre_completo }}
                </a>
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-2.5 rounded-full font-semibold transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gray-500/40">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        @else
            <!-- Login Button -->
            <button id="openLoginModal" class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-6 py-2.5 rounded-full font-semibold transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-amber-500/40">
                Iniciar Sesión
            </button>
        @endauth
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden text-2xl text-gray-900">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
</header>