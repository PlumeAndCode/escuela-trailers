<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener cursos existentes
        $cursos = DB::table('cursos')->get();
        
        if ($cursos->isEmpty()) {
            $this->command->warn('No hay cursos disponibles para crear lecciones.');
            return;
        }

        $lecciones = [];
        
        foreach ($cursos as $curso) {
            // Lecciones para cada curso
            $leccionesCurso = [
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Introducción a los Tráileres',
                    'descripcion' => 'Conoce los componentes básicos de un tráiler, sistemas de seguridad y normativas.',
                    'estado_leccion' => 'completada',
                    'observaciones' => 'Excelente comprensión de los conceptos básicos.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Inspección Pre-viaje',
                    'descripcion' => 'Aprende a realizar una inspección completa antes de iniciar el viaje.',
                    'estado_leccion' => 'completada',
                    'observaciones' => 'Completó satisfactoriamente la inspección de 12 puntos.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Arranque y Manejo Básico',
                    'descripcion' => 'Primeras prácticas de arranque, aceleración y frenado con tráiler.',
                    'estado_leccion' => 'en_progreso',
                    'observaciones' => 'Muestra progreso constante, necesita practicar más el frenado suave.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Giros y Cambios de Carril',
                    'descripcion' => 'Técnicas para realizar giros amplios y cambios de carril seguros.',
                    'estado_leccion' => 'no_iniciada',
                    'observaciones' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Estacionamiento en Reversa',
                    'descripcion' => 'Domina la técnica de estacionamiento en reversa con tráiler.',
                    'estado_leccion' => 'bloqueada',
                    'observaciones' => 'Requiere completar lecciones anteriores primero.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Conducción en Carretera',
                    'descripcion' => 'Prácticas de conducción en diferentes tipos de carreteras.',
                    'estado_leccion' => 'bloqueada',
                    'observaciones' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Maniobras en Espacios Reducidos',
                    'descripcion' => 'Técnicas avanzadas para maniobrar en espacios complicados.',
                    'estado_leccion' => 'bloqueada',
                    'observaciones' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Examen Final Práctico',
                    'descripcion' => 'Evaluación final de todas las habilidades aprendidas durante el curso.',
                    'estado_leccion' => 'bloqueada',
                    'observaciones' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            
            $lecciones = array_merge($lecciones, $leccionesCurso);
        }

        DB::table('lecciones')->insert($lecciones);
    }
}
