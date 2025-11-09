@extends('layouts.app')

@section('title', 'Contacto - DriveMaster Pro')

@section('content')
    <!-- PAGE HEADER -->
    <section class="bg-gradient-to-br from-gray-900 to-gray-800 py-20 text-white">
        <div class="container mx-auto px-5 text-center">
            <h1 class="text-5xl font-bold mb-4 animate-fadeInDown">Contáctanos</h1>
            <p class="text-xl text-gray-300 mb-8 animate-fadeInUp">
                Estamos aquí para atenderte y responder todas tus dudas
            </p>
            <div class="breadcrumb text-gray-300">
                <a href="{{ route('home') }}" class="text-amber-500 hover:text-amber-400 transition-colors">Inicio</a> 
                <span class="mx-2">/</span> 
                <span>Contacto</span>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Info Cards -->
                <div class="space-y-8">
                    <div class="info-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all border border-gray-100">
                        <div class="info-icon w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Visítanos</h3>
                        <div class="text-gray-600 space-y-2">
                            <p>1ERA. PRIVADA DE, C. Ortega y Montañes #12</p>
                            <p>Centro histórico de Morelia</p>
                            <p>58000 Morelia, Mich.</p>
                        </div>
                    </div>
                    
                    <div class="info-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all border border-gray-100">
                        <div class="info-icon w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Llámanos</h3>
                        <div class="text-gray-600 space-y-2">
                            <p>Teléfono: +52 443-312-5555</p>
                            <p>WhatsApp: +52 443-123-4567</p>
                        </div>
                    </div>
                    
                    <div class="info-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all border border-gray-100">
                        <div class="info-icon w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center text-white text-2xl mb-6">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Escríbenos</h3>
                        <div class="text-gray-600 space-y-2">
                            <p>info@escuelatrailer.com</p>
                            <p>soporte@escuelatrailer.com</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 rounded-3xl p-12">
                        <div class="contact-card bg-white rounded-2xl shadow-lg p-8">
                            <form class="contact-form">
                                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">CONTÁCTANOS</h2>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="input-group">
                                        <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
                                        <input type="text" placeholder="Tu nombre" 
                                               class="w-full px-4 py-3 border-b-2 border-gray-300 bg-transparent focus:outline-none focus:border-amber-500 transition-colors">
                                    </div>
                                    <div class="input-group">
                                        <label class="block text-gray-700 font-semibold mb-2">Apellido</label>
                                        <input type="text" placeholder="Tu apellido" 
                                               class="w-full px-4 py-3 border-b-2 border-gray-300 bg-transparent focus:outline-none focus:border-amber-500 transition-colors">
                                    </div>
                                </div>
                                
                                <div class="input-group mb-6">
                                    <label class="block text-gray-700 font-semibold mb-2">E-mail</label>
                                    <input type="email" placeholder="ejemplo@correo.com" 
                                           class="w-full px-4 py-3 border-b-2 border-gray-300 bg-transparent focus:outline-none focus:border-amber-500 transition-colors">
                                </div>
                                
                                <div class="input-group mb-8">
                                    <label class="block text-gray-700 font-semibold mb-2">Mensaje</label>
                                    <textarea rows="4" placeholder="Escribe tu mensaje..." 
                                              class="w-full px-4 py-3 border-b-2 border-gray-300 bg-transparent focus:outline-none focus:border-amber-500 transition-colors resize-none"></textarea>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white py-4 rounded-full font-bold text-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                                    Enviar Mensaje
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Horarios Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Horario de Atención</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">Estamos para Servirte</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="horario-card bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all">
                    <div class="dia text-xl font-bold text-gray-900 mb-3">Lunes - Viernes</div>
                    <div class="hora text-2xl text-amber-600 font-semibold">8:00 AM - 6:00 PM</div>
                </div>
                <div class="horario-card bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all">
                    <div class="dia text-xl font-bold text-gray-900 mb-3">Sábados</div>
                    <div class="hora text-2xl text-amber-600 font-semibold">9:00 AM - 2:00 PM</div>
                </div>
                <div class="horario-card bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all">
                    <div class="dia text-xl font-bold text-gray-900 mb-3">Domingos</div>
                    <div class="hora text-2xl text-amber-600 font-semibold">Cerrado</div>
                </div>
            </div>
        </div>
    </section>
@endsection