<div id="loginModal" class="{{ $errors->any() && !$errors->has('nombre_completo') ? 'flex' : 'hidden' }} fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] items-center justify-center p-5">
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
            
            <!-- Error Messages -->
            @if($errors->any() && !$errors->has('nombre_completo'))
                <div class="w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <!-- Form -->
            <form class="w-full" method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Input -->
                <div class="relative mb-5 w-full">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
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
                    <a href="{{ route('password.request') }}" class="text-amber-600 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-amber-500/50 transition-all"
                >
                    Entrar
                </button>
            </form>
            
            <!-- Register Link -->
            <div class="mt-6 text-center text-gray-600">
                ¿No tienes cuenta? 
                <button type="button" id="switchToRegister" class="text-amber-600 font-semibold hover:underline">
                    Regístrate
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="{{ $errors->has('nombre_completo') ? 'flex' : 'hidden' }} fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] items-center justify-center p-5">
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-10 max-w-md w-full relative shadow-2xl border border-gray-100 animate-slideIn max-h-[90vh] overflow-y-auto">
        <!-- Close Button -->
        <button id="closeRegisterModal" class="absolute right-5 top-4 text-2xl text-gray-600 hover:text-amber-600 transition-colors">
            &times;
        </button>
        
        <div class="flex flex-col items-center">
            <!-- Icon -->
            <div class="w-20 h-20 bg-amber-500 text-white rounded-full flex items-center justify-center text-3xl mb-5">
                <i class="fas fa-user-plus"></i>
            </div>
            
            <!-- Title -->
            <h2 class="text-gray-900 text-2xl font-bold mb-6">Crear Cuenta</h2>
            
            <!-- Error Messages -->
            @if($errors->has('nombre_completo') || $errors->has('password_confirmation'))
                <div class="w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <!-- Form -->
            <form class="w-full" method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name Input -->
                <div class="relative mb-4 w-full">
                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="text" 
                        name="nombre_completo"
                        value="{{ old('nombre_completo') }}"
                        placeholder="Nombre completo" 
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Email Input -->
                <div class="relative mb-4 w-full">
                    <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Correo electrónico" 
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Phone Input -->
                <div class="relative mb-4 w-full">
                    <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="tel" 
                        name="telefono"
                        value="{{ old('telefono') }}"
                        placeholder="Teléfono (opcional)" 
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Password Input -->
                <div class="relative mb-4 w-full">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="password" 
                        name="password"
                        placeholder="Contraseña" 
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Confirm Password Input -->
                <div class="relative mb-6 w-full">
                    <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input 
                        type="password" 
                        name="password_confirmation"
                        placeholder="Confirmar contraseña" 
                        required
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-amber-600 focus:bg-white transition-all"
                    >
                </div>
                
                <!-- Terms Checkbox -->
                <div class="flex items-start gap-2 mb-6 w-full text-sm text-gray-600">
                    <input type="checkbox" name="terms" required class="rounded border-gray-300 mt-1">
                    <span>Acepto los <a href="#" class="text-amber-600 hover:underline">términos y condiciones</a> y la <a href="#" class="text-amber-600 hover:underline">política de privacidad</a></span>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-amber-500/50 transition-all"
                >
                    Crear Cuenta
                </button>
            </form>
            
            <!-- Login Link -->
            <div class="mt-6 text-center text-gray-600">
                ¿Ya tienes cuenta? 
                <button type="button" id="switchToLogin" class="text-amber-600 font-semibold hover:underline">
                    Inicia sesión
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Verify Email Modal -->
@auth
@if(!auth()->user()->hasVerifiedEmail())
<div id="verifyEmailModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[1000] flex items-center justify-center p-5">
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-10 max-w-md w-full relative shadow-2xl border border-gray-100 animate-slideIn">
        <div class="flex flex-col items-center">
            <!-- Icon -->
            <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center text-3xl mb-5">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            
            <!-- Title -->
            <h2 class="text-gray-900 text-2xl font-bold mb-4">Verifica tu Correo</h2>
            
            <!-- Message -->
            <p class="text-gray-600 text-center mb-6">
                ¡Gracias por registrarte! Te hemos enviado un enlace de verificación a 
                <span class="font-semibold text-amber-600">{{ auth()->user()->email }}</span>. 
                Por favor revisa tu bandeja de entrada.
            </p>
            
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm text-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    ¡Se ha enviado un nuevo enlace de verificación!
                </div>
            @endif
            
            <!-- Resend Form -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full mb-4">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-full py-3 font-semibold shadow-lg shadow-amber-500/30 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-amber-500/50 transition-all"
                >
                    <i class="fas fa-paper-plane mr-2"></i>
                    Reenviar Correo de Verificación
                </button>
            </form>
            
            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-gray-200 text-gray-700 rounded-full py-3 font-semibold hover:bg-gray-300 transition-all"
                >
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Cerrar Sesión
                </button>
            </form>
            
            <!-- Help Text -->
            <p class="text-gray-500 text-sm mt-6 text-center">
                ¿No recibiste el correo? Revisa tu carpeta de spam o 
                <a href="{{ route('profile.show') }}" class="text-amber-600 hover:underline">edita tu perfil</a> 
                si necesitas cambiar tu email.
            </p>
        </div>
    </div>
</div>
@endif
@endauth

@push('scripts')
<script>
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const openLoginBtn = document.getElementById('openLoginModal');
    const closeLoginBtn = document.getElementById('closeLoginModal');
    const closeRegisterBtn = document.getElementById('closeRegisterModal');
    const switchToRegisterBtn = document.getElementById('switchToRegister');
    const switchToLoginBtn = document.getElementById('switchToLogin');

    // Open Login Modal
    openLoginBtn?.addEventListener('click', () => {
        loginModal.classList.remove('hidden');
        loginModal.classList.add('flex');
    });

    // Close Login Modal
    closeLoginBtn?.addEventListener('click', () => {
        loginModal.classList.add('hidden');
        loginModal.classList.remove('flex');
    });

    // Close Register Modal
    closeRegisterBtn?.addEventListener('click', () => {
        registerModal.classList.add('hidden');
        registerModal.classList.remove('flex');
    });

    // Switch to Register Modal
    switchToRegisterBtn?.addEventListener('click', () => {
        loginModal.classList.add('hidden');
        loginModal.classList.remove('flex');
        registerModal.classList.remove('hidden');
        registerModal.classList.add('flex');
    });

    // Switch to Login Modal
    switchToLoginBtn?.addEventListener('click', () => {
        registerModal.classList.add('hidden');
        registerModal.classList.remove('flex');
        loginModal.classList.remove('hidden');
        loginModal.classList.add('flex');
    });

    // Close on backdrop click
    window.addEventListener('click', (e) => {
        if (e.target === loginModal) {
            loginModal.classList.add('hidden');
            loginModal.classList.remove('flex');
        }
        if (e.target === registerModal) {
            registerModal.classList.add('hidden');
            registerModal.classList.remove('flex');
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            loginModal.classList.add('hidden');
            loginModal.classList.remove('flex');
            registerModal.classList.add('hidden');
            registerModal.classList.remove('flex');
        }
    });
</script>
@endpush