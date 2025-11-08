@extends('layouts.app')

@section('title', 'Servicios - DriveMaster Pro')

@section('content')
    <!-- PAGE HEADER -->
    <section class="bg-gradient-to-br from-gray-900 to-gray-800 py-20 text-white">
        <div class="container mx-auto px-5 text-center">
            <h1 class="text-5xl font-bold mb-4 animate-fadeInDown">Nuestros Cursos y Servicios</h1>
            <p class="text-xl text-gray-300 mb-8 animate-fadeInUp">
                Encuentra el programa perfecto para ti y comienza tu carrera profesional como conductor de tráiler
            </p>
            <div class="breadcrumb text-gray-300">
                <a href="{{ route('home') }}" class="text-amber-500 hover:text-amber-400 transition-colors">Inicio</a> 
                <span class="mx-2">/</span> 
                <span>Cursos</span>
            </div>
        </div>
    </section>

    <!-- PLANES -->
    @include('components.planes')

    <!-- PROCESO -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-amber-500 font-semibold text-lg">Proceso de Inscripción</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2">¿Cómo Empezar?</h2>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <!-- Timeline -->
                <div class="relative">
                    <!-- Linea central -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-amber-500 h-full"></div>
                    
                    <!-- Paso 1 -->
                    <div class="flex items-center mb-12">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">1. Selecciona tu Curso</h3>
                                <p class="text-gray-600">
                                    Elige el programa que mejor se adapte a tus necesidades y objetivos profesionales. 
                                    Nuestros asesores pueden ayudarte a decidir.
                                </p>
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            1
                        </div>
                        <div class="w-1/2"></div>
                    </div>

                    <!-- Paso 2 -->
                    <div class="flex items-center mb-12">
                        <div class="w-1/2"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            2
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">2. Regístrate Online</h3>
                                <p class="text-gray-600">
                                    Completa el formulario de inscripción en nuestro sitio web. 
                                    Asegúrate de proporcionar toda la información requerida.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Paso 3 -->
                    <div class="flex items-center mb-12">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">3. Realiza el Pago</h3>
                                <p class="text-gray-600">
                                    Elige tu método de pago preferido y completa la transacción. 
                                    Ofrecemos opciones seguras y flexibles para tu comodidad.
                                </p>
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            3
                        </div>
                        <div class="w-1/2"></div>
                    </div>

                    <!-- Paso 4 -->
                    <div class="flex items-center">
                        <div class="w-1/2"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                            4
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">4. Comienza tu Formación</h3>
                                <p class="text-gray-600">
                                    Accede a tus materiales de estudio y programa tus primeras lecciones. 
                                    Nuestro equipo estará contigo en cada paso del camino.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="py-20 bg-gradient-to-r from-amber-500 to-amber-600 text-white text-center">
        <div class="container mx-auto px-5">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl font-bold mb-6">¿Listo para dar el siguiente paso?</h2>
                <p class="text-xl mb-8 opacity-95">
                    Inscríbete hoy mismo y comienza tu camino hacia una carrera exitosa como conductor profesional de tráiler.
                </p>
                <a href="{{ route('contact') }}" 
                   class="bg-white text-amber-600 px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl hover:-translate-y-1 transition-all inline-block">
                    Contáctanos Ahora
                </a>
            </div>
        </div>
    </section>
@endsection