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
        // Obtener cursos existentes con su avance
        $cursos = DB::table('cursos')->get();
        
        if ($cursos->isEmpty()) {
            $this->command->warn('No hay cursos disponibles para crear lecciones.');
            return;
        }

        $lecciones = [];
        
        foreach ($cursos as $curso) {
            // Determinar estados de lecciones según el avance del curso
            $avance = $curso->avance_porcentaje;
            
            if ($avance >= 100) {
                // Curso completado - todas las lecciones completadas
                $estados = ['completada', 'completada', 'completada', 'completada', 'completada', 'completada', 'completada', 'completada'];
            } elseif ($avance >= 60) {
                // Curso avanzado - 5 completadas, 1 en progreso, 2 bloqueadas
                $estados = ['completada', 'completada', 'completada', 'completada', 'completada', 'en_progreso', 'bloqueada', 'bloqueada'];
            } elseif ($avance >= 25) {
                // Curso intermedio - 2 completadas, 1 en progreso, resto no iniciadas/bloqueadas
                $estados = ['completada', 'completada', 'en_progreso', 'no_iniciada', 'bloqueada', 'bloqueada', 'bloqueada', 'bloqueada'];
            } else {
                // Curso recién iniciado - 1 completada o en progreso
                $estados = ['completada', 'en_progreso', 'no_iniciada', 'bloqueada', 'bloqueada', 'bloqueada', 'bloqueada', 'bloqueada'];
            }
            
            $leccionesCurso = [
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Introducción a los Tráileres',
                    'descripcion' => 'Conoce los componentes básicos de un tráiler, sistemas de seguridad y normativas.',
                    'estado_leccion' => $estados[0],
                    'observaciones' => $estados[0] === 'completada' ? 'Excelente comprensión de los conceptos básicos.' : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Inspección Pre-viaje',
                    'descripcion' => 'Aprende a realizar una inspección completa antes de iniciar el viaje.',
                    'estado_leccion' => $estados[1],
                    'observaciones' => $estados[1] === 'completada' ? 'Completó satisfactoriamente la inspección de 12 puntos.' : ($estados[1] === 'en_progreso' ? 'En proceso de aprendizaje.' : null),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Arranque y Manejo Básico',
                    'descripcion' => 'Primeras prácticas de arranque, aceleración y frenado con tráiler.',
                    'estado_leccion' => $estados[2],
                    'observaciones' => $estados[2] === 'completada' ? 'Domina correctamente el arranque y frenado.' : ($estados[2] === 'en_progreso' ? 'Necesita practicar más el frenado suave.' : null),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Giros y Cambios de Carril',
                    'descripcion' => 'Técnicas para realizar giros amplios y cambios de carril seguros.',
                    'estado_leccion' => $estados[3],
                    'observaciones' => $estados[3] === 'completada' ? 'Excelente manejo en curvas y cambios de carril.' : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Estacionamiento en Reversa',
                    'descripcion' => 'Domina la técnica de estacionamiento en reversa con tráiler.',
                    'estado_leccion' => $estados[4],
                    'observaciones' => $estados[4] === 'completada' ? 'Logró dominar las maniobras de reversa.' : ($estados[4] === 'bloqueada' ? 'Requiere completar lecciones anteriores primero.' : null),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Conducción en Carretera',
                    'descripcion' => 'Prácticas de conducción en diferentes tipos de carreteras.',
                    'estado_leccion' => $estados[5],
                    'observaciones' => $estados[5] === 'completada' ? 'Manejo seguro en carretera abierta.' : ($estados[5] === 'en_progreso' ? 'Practicando conducción en autopista.' : null),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Maniobras en Espacios Reducidos',
                    'descripcion' => 'Técnicas avanzadas para maniobrar en espacios complicados.',
                    'estado_leccion' => $estados[6],
                    'observaciones' => $estados[6] === 'completada' ? 'Excelentes habilidades en espacios reducidos.' : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'id_curso' => $curso->id,
                    'nombre_leccion' => 'Examen Final Práctico',
                    'descripcion' => 'Evaluación final de todas las habilidades aprendidas durante el curso.',
                    'estado_leccion' => $estados[7],
                    'observaciones' => $estados[7] === 'completada' ? '¡Felicidades! Aprobó el examen final con 95/100.' : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            
            $lecciones = array_merge($lecciones, $leccionesCurso);
        }

        DB::table('lecciones')->insert($lecciones);
        $this->command->info('✅ Lecciones creadas con variedad de estados según avance del curso');
    }
}
