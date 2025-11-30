<x-guest-layout>
    <!-- Forgot Password Modal (siempre visible en esta página) -->
    <div id="forgotPasswordModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] flex items-center justify-center p-5">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-10 max-w-md w-full relative shadow-2xl border border-gray-100 animate-slideIn">
            <!-- Close Button -->
            <a href="{{ route('login') }}" class="absolute right-5 top-4 text-2xl text-gray-600 hover:text-amber-600 transition-colors">
                &times;
            </a>
            
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center text-3xl mb-5">
                    <i class="fas fa-unlock-alt"></i>
                </div>
                
                <!-- Title -->
                <h2 class="text-gray-900 text-2xl font-bold mb-4">Recuperar Contraseña</h2>
                
                <!-- Message -->
                <p class="text-gray-600 text-center mb-6">
                    ¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu correo electrónico y te enviaremos un enlace para restablecerla.
                </p>
                
                <!-- Success Message -->
                @if (session('status'))
                    <div class="w-full mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm text-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('status') }}
                    </div>
                @endif
                
                <!-- Error Messages -->
                @if($errors->any())
                    <div class="w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                
                <!-- Form -->
                <form class="w-full" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <!-- Email Input -->
                    <div class="relative mb-6 w-full">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        <input 
                            type="email" 
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Correo electrónico" 
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                        >
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-amber-500/50 transition-all"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Enlace de Recuperación
                    </button>
                </form>
                
                <!-- Back to Login Link -->
                <div class="mt-6 text-center text-gray-600">
                    <a href="{{ route('login') }}" class="text-amber-600 font-semibold hover:underline">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Volver al inicio de sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
