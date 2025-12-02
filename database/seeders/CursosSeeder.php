<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener contrataciones de tipo curso
        $serviciosCurso = DB::table('servicios')
            ->where('tipo_servicio', 'curso')
            ->pluck('id');
        
        $contratacionesCurso = DB::table('contrataciones')
            ->whereIn('id_servicio', $serviciosCurso)
            ->get();
        
        if ($contratacionesCurso->isEmpty()) {
            $this->command->warn('No hay contrataciones de cursos para crear cursos.');
            return;
        }

        $cursos = [];
        
        foreach ($contratacionesCurso as $index => $contratacion) {
            // Variedad de nombres y avances según el estado
            if ($contratacion->estado_contratacion === 'activo') {
                if ($index === 0) {
                    // Curso con buen avance (cliente 1)
                    $cursos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'nombre_curso' => 'Curso Completo de Manejo de Tráiler',
                        'descripcion' => 'Aprende desde cero a manejar tráileres con seguridad. Incluye fundamentos teóricos y prácticas supervisadas.',
                        'avance_porcentaje' => 62.50, // 5 de 8 lecciones
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                } else {
                    // Curso recién iniciado (cliente 2)
                    $cursos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'nombre_curso' => 'Curso Básico de Manejo de Tráiler',
                        'descripcion' => 'Curso introductorio para principiantes en manejo de vehículos pesados.',
                        'avance_porcentaje' => 12.50, // 1 de 8 lecciones
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            } elseif ($contratacion->estado_contratacion === 'finalizado') {
                // Curso completado (cliente 3)
                $cursos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'nombre_curso' => 'Curso Avanzado de Maniobras con Tráiler',
                    'descripcion' => 'Perfecciona tus habilidades con maniobras complejas y técnicas avanzadas de conducción.',
                    'avance_porcentaje' => 100.00, // Completado
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($cursos)) {
            DB::table('cursos')->insert($cursos);
            $this->command->info('✅ Cursos creados con diferentes niveles de avance');
        }
    }
}
