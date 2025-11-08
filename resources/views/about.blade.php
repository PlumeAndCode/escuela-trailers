@extends('layouts.app')

@section('title', 'Nosotros - DriveMaster Pro')

@section('content')
    <!-- PAGE HEADER -->
    <section class="bg-gradient-to-br from-gray-900 to-gray-800 py-20 text-white">
        <div class="container mx-auto px-5 text-center">
            <h1 class="text-5xl font-bold mb-4 animate-fadeInDown">Sobre Nosotros</h1>
            <p class="text-xl text-gray-300 mb-8 animate-fadeInUp">
                Más de 15 años formando conductores profesionales de tráiler en México
            </p>
            <div class="breadcrumb text-gray-300">
                <a href="{{ route('home') }}" class="text-amber-500 hover:text-amber-400 transition-colors">Inicio</a> 
                <span class="mx-2">/</span> 
                <span>Nosotros</span>
            </div>
        </div>
    </section>

    <!-- HISTORIA -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="historia-text">
                    <span class="text-amber-500 font-semibold text-lg uppercase tracking-wider">Nuestra Historia</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-6">
                        15 Años de <span class="text-amber-500">Excelencia</span> en Educación Vial
                    </h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            DriveMaster Pro nació en 2009 con una visión clara: transformar la industria del transporte pesado en México mediante la formación de conductores altamente capacitados y profesionales.
                        </p>
                        <p>
                            Fundada por el Ing. Roberto Martínez, un veterano con más de 25 años de experiencia en transporte de carga, nuestra escuela comenzó con apenas 2 tráilers y un equipo de 3 instructores apasionados por la enseñanza.
                        </p>
                        <p>
                            Hoy, somos la escuela de manejo de tráilers más reconocida en Michoacán, con más de 2,500 alumnos graduados y una tasa de aprobación del 95%.
                        </p>
                    </div>

                    <div class="timeline mt-8 space-y-6">
                        <div class="timeline-item flex items-start gap-6">
                            <div class="timeline-year bg-gradient-to-r from-amber-500 to-amber-600 text-white px-4 py-2 rounded-lg font-bold text-lg min-w-20 text-center">
                                2009
                            </div>
                            <div class="timeline-content">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Fundación</h4>
                                <p class="text-gray-600">Inicio de operaciones en Morelia con 2 unidades</p>
                            </div>
                        </div>
                        <div class="timeline-item flex items-start gap-6">
                            <div class="timeline-year bg-gradient-to-r from-amber-500 to-amber-600 text-white px-4 py-2 rounded-lg font-bold text-lg min-w-20 text-center">
                                2013
                            </div>
                            <div class="timeline-content">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Expansión</h4>
                                <p class="text-gray-600">Alcanzamos los 1,000 alumnos graduados</p>
                            </div>
                        </div>
                        <div class="timeline-item flex items-start gap-6">
                            <div class="timeline-year bg-gradient-to-r from-amber-500 to-amber-600 text-white px-4 py-2 rounded-lg font-bold text-lg min-w-20 text-center">
                                2018
                            </div>
                            <div class="timeline-content">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Certificación Nacional</h4>
                                <p class="text-gray-600">Reconocimiento SCT como centro autorizado</p>
                            </div>
                        </div>
                        <div class="timeline-item flex items-start gap-6">
                            <div class="timeline-year bg-gradient-to-r from-amber-500 to-amber-600 text-white px-4 py-2 rounded-lg font-bold text-lg min-w-20 text-center">
                                2024
                            </div>
                            <div class="timeline-content">
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Líderes del Sector</h4>
                                <p class="text-gray-600">12 tráilers modernos y equipo de 15 instructores</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="historia-image relative">
                    <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=600&h=700&fit=crop" 
                         alt="Historia DriveMaster" 
                         class="w-full rounded-2xl shadow-2xl">
                    <div class="historia-badge absolute -bottom-6 -left-6 bg-white p-8 rounded-2xl shadow-2xl text-center">
                        <div class="number text-5xl font-bold text-amber-500 leading-none">15+</div>
                        <div class="text text-gray-900 font-semibold mt-2">Años de<br>Experiencia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MISIÓN Y VISIÓN -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Nuestro Propósito</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Misión y Visión</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <div class="mv-card bg-white p-12 rounded-2xl shadow-lg relative overflow-hidden border-t-4 border-amber-500">
                    <div class="mv-card-icon text-6xl mb-6">🎯</div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Nuestra Misión</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        Formar conductores profesionales de tráiler altamente capacitados, promoviendo la seguridad vial y la excelencia operativa en el sector del transporte. Nos comprometemos a brindar educación de calidad con instructores certificados, equipos modernos y programas personalizados que garanticen el éxito de cada alumno.
                    </p>
                </div>
                <div class="mv-card bg-white p-12 rounded-2xl shadow-lg relative overflow-hidden border-t-4 border-amber-500">
                    <div class="mv-card-icon text-6xl mb-6">🚀</div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Nuestra Visión</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        Ser la escuela de manejo de tráilers líder en México, reconocida por su excelencia académica, innovación en métodos de enseñanza y compromiso con la seguridad. Aspiramos a expandir nuestra presencia a nivel nacional, manteniendo siempre los más altos estándares de calidad y profesionalismo.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- VALORES -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Lo que nos define</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Nuestros Valores</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <div class="valor-card bg-gray-50 p-8 rounded-2xl text-center border-2 border-transparent hover:border-amber-500 hover:shadow-xl transition-all">
                    <div class="valor-icon w-20 h-20 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-3xl text-white mx-auto mb-6">
                        🛡️
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Seguridad</h4>
                    <p class="text-gray-600">
                        La seguridad es nuestra prioridad número uno. Cada lección, cada práctica y cada evaluación se realiza bajo los más estrictos protocolos de seguridad.
                    </p>
                </div>
                <div class="valor-card bg-gray-50 p-8 rounded-2xl text-center border-2 border-transparent hover:border-amber-500 hover:shadow-xl transition-all">
                    <div class="valor-icon w-20 h-20 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-3xl text-white mx-auto mb-6">
                        ⭐
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Excelencia</h4>
                    <p class="text-gray-600">
                        Nos esforzamos constantemente por superar las expectativas, ofreciendo servicios de la más alta calidad y resultados sobresalientes.
                    </p>
                </div>
                <div class="valor-card bg-gray-50 p-8 rounded-2xl text-center border-2 border-transparent hover:border-amber-500 hover:shadow-xl transition-all">
                    <div class="valor-icon w-20 h-20 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-3xl text-white mx-auto mb-6">
                        🤝
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Compromiso</h4>
                    <p class="text-gray-600">
                        Estamos comprometidos con el éxito de cada alumno, brindando apoyo personalizado y seguimiento continuo en su proceso de aprendizaje.
                    </p>
                </div>
                <div class="valor-card bg-gray-50 p-8 rounded-2xl text-center border-2 border-transparent hover:border-amber-500 hover:shadow-xl transition-all">
                    <div class="valor-icon w-20 h-20 bg-gradient-to-r from-amber-500 to-amber-600 rounded-full flex items-center justify-center text-3xl text-white mx-auto mb-6">
                        💎
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Profesionalismo</h4>
                    <p class="text-gray-600">
                        Mantenemos los más altos estándares de profesionalismo en cada aspecto de nuestra operación, desde la enseñanza hasta el servicio al cliente.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- EQUIPO -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Conoce a nuestro equipo</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Instructores Certificados</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                <!-- Instructor 1 -->
                <div class="instructor-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <div class="instructor-image relative h-80 bg-gradient-to-br from-gray-900 to-gray-800 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&h=400&fit=crop" 
                             alt="Roberto Martínez" 
                             class="w-full h-full object-cover">
                        <div class="instructor-social absolute bottom-0 left-0 right-0 bg-amber-500/90 p-4 flex justify-center gap-4 transform translate-y-full transition-transform duration-300">
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-amber-500 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-amber-500 transition-colors">
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-amber-500 transition-colors">
                                <i class="fas fa-user"></i>
                            </a>
                        </div>
                    </div>
                    <div class="instructor-info p-6 text-center">
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Ing. Roberto Martínez</h4>
                        <span class="text-amber-600 font-semibold block mb-4">Director General & Fundador</span>
                        <p class="text-gray-600 mb-6">
                            Ingeniero con 25 años de experiencia en transporte de carga. Especialista en logística y seguridad vial.
                        </p>
                        <div class="instructor-stats flex justify-around border-t border-gray-200 pt-4">
                            <div class="instructor-stat text-center">
                                <div class="number text-2xl font-bold text-amber-600">25+</div>
                                <div class="label text-sm text-gray-600">Años</div>
                            </div>
                            <div class="instructor-stat text-center">
                                <div class="number text-2xl font-bold text-amber-600">1500+</div>
                                <div class="label text-sm text-gray-600">Alumnos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instructor 2 -->
                <div class="instructor-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <div class="instructor-image relative h-80 bg-gradient-to-br from-gray-900 to-gray-800 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop" 
                             alt="Carlos Hernández" 
                             class="w-full h-full object-cover">
                        <div class="instructor-social absolute bottom-0 left-0 right-0 bg-amber-500/90 p-4 flex justify-center gap-4 transform translate-y-full transition-transform duration-300">
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-amber-500 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-amber-500 transition-colors">
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white hover:bg-white hover:text-amber-500 transition-colors">
                                <i class="fas fa-user"></i>
                            </a>
                        </div>
                    </div>
                    <div class="instructor-info p-6 text-center">
                        <h4 class="text-2xl font-bold text-gray-900 mb-2">Carlos Hernández</h4>
                        <span class="text-amber-600 font-semibold block mb-4">Instructor Principal</span>
                        <p class="text-gray-600 mb-6">
                            Conductor profesional con 18 años de experiencia. Certificado en manejo defensivo y maniobras especiales.
                        </p>
                        <div class="instructor-stats flex justify-around border-t border-gray-200 pt-4">
                            <div class="instructor-stat text-center">
                                <div class="number text-2xl font-bold text-amber-600">18+</div>
                                <div class="label text-sm text-gray-600">Años</div>
                            </div>
                            <div class="instructor-stat text-center">
                                <div class="number text-2xl font-bold text-amber-600">1200+</div>
                                <div class="label text-sm text-gray-600">Alumnos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Efecto hover para las tarjetas de instructor
    document.querySelectorAll('.instructor-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.instructor-social').style.transform = 'translateY(0)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.querySelector('.instructor-social').style.transform = 'translateY(100%)';
        });
    });
</script>
@endpush