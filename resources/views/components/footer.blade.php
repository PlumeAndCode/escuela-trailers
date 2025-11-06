<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-5">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            <!-- DriveMaster Pro -->
            <div class="footer-section">
                <h3 class="text-amber-500 mb-5 text-xl font-semibold">DriveMaster Pro</h3>
                <p class="text-gray-300 leading-relaxed mb-4">
                    La escuela de manejo más confiable de México. Formando conductores profesionales desde 2009.
                </p>
                <div class="text-gray-300 space-y-2">
                    <div class="flex items-center">
                        <span class="text-amber-500 mr-2">📍</span>
                        Av. Principal #123, Morelia, Michoacán
                    </div>
                    <div class="flex items-center">
                        <span class="text-amber-500 mr-2">📞</span>
                        +52 443 123 4567
                    </div>
                    <div class="flex items-center">
                        <span class="text-amber-500 mr-2">✉️</span>
                        info@drivemaster.com
                    </div>
                </div>
            </div>
            
            <!-- Servicios -->
            <div class="footer-section">
                <h3 class="text-amber-500 mb-5 text-xl font-semibold">Servicios</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Curso Completo</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Lecciones Individuales</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Trámite de Licencia</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Renta de Tráilers</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Cursos Corporativos</a></li>
                </ul>
            </div>
            
            <!-- Enlaces Rápidos -->
            <div class="footer-section">
                <h3 class="text-amber-500 mb-5 text-xl font-semibold">Enlaces Rápidos</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Sobre Nosotros</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Servicios</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-amber-500 transition-colors">Contacto</a></li>
                </ul>
            </div>
            
            <!-- Horarios -->
            <div class="footer-section">
                <h3 class="text-amber-500 mb-5 text-xl font-semibold">Horarios</h3>
                <div class="text-gray-300 space-y-4">
                    <div>
                        <strong class="text-white">Lunes - Viernes:</strong><br>
                        8:00 AM - 8:00 PM
                    </div>
                    <div>
                        <strong class="text-white">Sábados:</strong><br>
                        9:00 AM - 6:00 PM
                    </div>
                    <div>
                        <strong class="text-white">Domingos:</strong><br>
                        10:00 AM - 3:00 PM
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="border-t border-gray-700 pt-8 text-center">
            <p class="text-gray-400">
                &copy; 2025 DriveMaster Pro. Todos los derechos reservados. | 
                <a href="#" class="text-amber-500 hover:text-amber-400 transition-colors">Política de Privacidad</a> | 
                <a href="#" class="text-amber-500 hover:text-amber-400 transition-colors">Términos y Condiciones</a>
            </p>
        </div>
    </div>
</footer>