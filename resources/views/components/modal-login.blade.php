<div id="loginModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] items-center justify-center p-5">
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-10 max-w-md w-full relative shadow-2xl border border-gray-100 animate-slideIn">
        <!-- Close Button -->
        <button id="closeLoginModal" class="absolute right-5 top-4 text-2xl text-gray-600 hover:text-amber-600 transition-colors">
            &times;
        </button>
        
        <div class="flex flex-col items-center">
            <!-- Icon -->
            <div class="w-20 h-20 bg-gray-900 text-white rounded-full flex items-center justify-center text-3xl mb-5">
                <i class="fas fa-user"></i>
            </div>
            
            <!-- Title -->
            <h2 class="text-gray-900 text-2xl font-bold mb-6">Iniciar Sesión</h2>
            
            <!-- Form -->
            <form class="w-full" method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Input -->
                <div class="relative mb-5 w-full">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="email" 
                        name="email"
                        placeholder="Correo electrónico" 
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Password Input -->
                <div class="relative mb-5 w-full">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="password" 
                        name="password"
                        placeholder="Contraseña" 
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Options -->
                <div class="flex justify-between items-center w-full text-sm text-gray-600 mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300">
                        Recordarme
                    </label>
                    <a href="#" class="text-amber-600 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-amber-500/50 transition-all"
                >
                    Entrar
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const modal = document.getElementById('loginModal');
    const openBtn = document.getElementById('openLoginModal');
    const closeBtn = document.getElementById('closeLoginModal');

    openBtn?.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeBtn?.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
</script>
@endpush