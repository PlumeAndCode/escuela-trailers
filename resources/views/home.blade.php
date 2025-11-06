@extends('layouts.app')

@section('title', 'Inicio - DriveMaster Pro')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-gray-900/95 to-gray-700/90 min-h-[600px] flex items-center text-white relative overflow-hidden">
        <div class="container mx-auto px-5 grid md:grid-cols-2 gap-16 items-center">
            <div class="animate-fadeInUp">
                <h1 class="text-5xl md:text-6xl font-bold mb-5 leading-tight">
                    Aprende a Conducir <span class="text-amber-500">Tráilers</span> con los Profesionales
                </h1>
                <p class="text-xl mb-8 text-gray-300">
                    La mejor escuela de manejo especializada en tráilers. Instructores certificados, unidades modernas y programas personalizados para tu éxito.
                </p>
                <div class="flex gap-5 flex-wrap">
                    <a href="{{ route('services') }}" 
                       class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-9 py-4 rounded-full font-semibold hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-500/40 transition-all inline-block">
                        Ver Servicios
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-9 py-4 rounded-full font-semibold hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-500/40 transition-all inline-block">
                        Contáctanos
                    </a>
                </div>
            </div>
            
            <!-- SVG Truck -->
            <div class="hidden md:block">
                <svg width="500" height="400" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                    <!-- Tráiler simplificado -->
                    <defs>
                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <!-- Cabina -->
                    <rect x="50" y="180" width="120" height="100" fill="url(#grad1)" rx="10"/>
                    <rect x="60" y="190" width="40" height="40" fill="#1a202c" rx="5"/>
                    <!-- Remolque -->
                    <rect x="180" y="150" width="280" height="130" fill="#2d3748" rx="10"/>
                    <rect x="200" y="170" width="240" height="90" fill="#4a5568" rx="5"/>
                    <!-- Ruedas -->
                    <circle cx="90" cy="290" r="20" fill="#1a202c"/>
                    <circle cx="90" cy="290" r="12" fill="#718096"/>
                    <circle cx="140" cy="290" r="20" fill="#1a202c"/>
                    <circle cx="140" cy="290" r="12" fill="#718096"/>
                    <circle cx="240" cy="290" r="20" fill="#1a202c"/>
                    <circle cx="240" cy="290" r="12" fill="#718096"/>
                    <circle cx="290" cy="290" r="20" fill="#1a202c"/>
                    <circle cx="290" cy="290" r="12" fill="#718096"/>
                    <circle cx="400" cy="290" r="20" fill="#1a202c"/>
                    <circle cx="400" cy="290" r="12" fill="#718096"/>
                    <!-- Detalles -->
                    <circle cx="80" cy="200" r="8" fill="#fbbf24"/>
                    <rect x="100" y="195" width="30" height="3" fill="#fbbf24"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">¿Por qué elegirnos?</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Ventajas de Estudiar con Nosotros</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="text-4xl mb-4">👨‍🏫</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Instructores Certificados</h3>
                    <p class="text-gray-600">Más de 15 años de experiencia en la industria del transporte y educación vial profesional.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="text-4xl mb-4">🚛</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Flota Moderna</h3>
                    <p class="text-gray-600">Tráilers equipados con la última tecnología y sistemas de seguridad actualizados.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="text-4xl mb-4">📚</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Programas Personalizados</h3>
                    <p class="text-gray-600">Cursos adaptados a tu nivel y necesidades, desde principiantes hasta avanzados.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="text-4xl mb-4">✅</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Alta Tasa de Aprobación</h3>
                    <p class="text-gray-600">95% de nuestros alumnos aprueban su examen en el primer intento.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Nuestros Servicios</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Elige el Servicio que Necesitas</h2>
                <!-- Aquí incluirías tu componente de planes -->
                 @include('components.planes') 
            </div>
        </div>
    </section>

    <!-- Estadísticas -->
    <section class="py-20 bg-gradient-to-r  from-gray-900 to-gray-800 text-white">
        <div class="container mx-auto px-5">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold mb-2">2,500+</div>
                    <div class="text-lg">Alumnos Graduados</div>
                </div>
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold mb-2">15</div>
                    <div class="text-lg">Años de Experiencia</div>
                </div>
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold mb-2">95%</div>
                    <div class="text-lg">Tasa de Aprobación</div>
                </div>
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold mb-2">12</div>
                    <div class="text-lg">Tráilers Disponibles</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="py-20 bg-white" id="testimonios">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Testimonios</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Lo Que Dicen Nuestros Alumnos</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">J</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Juan Pérez</h4>
                            <p class="text-gray-600 text-sm">Conductor Profesional</p>
                        </div>
                    </div>
                    <div class="text-amber-400 mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-700 italic">"Excelente escuela, los instructores son muy profesionales y pacientes. Aprobé mi examen en el primer intento gracias a su preparación."</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">M</div>
                        <div>
                            <h4 class="font-bold text-gray-900">María González</h4>
                            <p class="text-gray-600 text-sm">Operadora de Logística</p>
                        </div>
                    </div>
                    <div class="text-amber-400 mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-700 italic">"Las unidades están en perfectas condiciones y el programa es muy completo. Me siento segura conduciendo gracias a DriveMaster."</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">C</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Carlos Ruiz</h4>
                            <p class="text-gray-600 text-sm">Empresario</p>
                        </div>
                    </div>
                    <div class="text-amber-400 mb-4">⭐⭐⭐⭐⭐</div>
                    <p class="text-gray-700 italic">"Renté varios tráilers para mi empresa y el servicio fue impecable. Profesionalismo y puntualidad garantizados."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gradient-to-r from-gray-900 to-gray-800 text-white text-center">
        <div class="container mx-auto px-5">
            <h2 class="text-4xl font-bold mb-4">¿Listo para Comenzar tu Carrera?</h2>
            <p class="text-xl mb-8 text-gray-300">Inscríbete hoy</p>
            <a href="{{ route('contact') }}" class="bg-white text-amber-500 px-9 py-4 rounded-full font-semibold hover:-translate-y-1 hover:shadow-xl transition-all inline-block">
                Contáctanos Ahora
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Contador animado para las estadísticas
    const animateCounter = (element, target) => {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + (target < 100 ? '%' : '+');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + (target < 100 ? '%' : '+');
            }
        }, 20);
    };

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const number = entry.target.querySelector('.text-4xl');
                const text = number.textContent;
                const value = parseInt(text.replace(/[^0-9]/g, ''));
                animateCounter(number, value);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-item').forEach(el => {
        statsObserver.observe(el);
    });
</script>
@endpush