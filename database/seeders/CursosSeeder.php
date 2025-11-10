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
        // Obtener contrataciones de tipo curso que estén activas
        $serviciosCurso = DB::table('servicios')
            ->where('tipo_servicio', 'curso')
            ->pluck('id');
        
        $contratacionesCurso = DB::table('contrataciones')
            ->whereIn('id_servicio', $serviciosCurso)
            ->where('estado_contratacion', 'activo')
            ->get();
        
        if ($contratacionesCurso->isEmpty()) {
            $this->command->warn('No hay contrataciones de cursos activas para crear cursos.');
            return;
        }

        $cursos = [];
        
        foreach ($contratacionesCurso as $index => $contratacion) {
            if ($index === 0) {
                $cursos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'nombre_curso' => 'Curso Básico de Manejo de Tráiler',
                    'descripcion' => 'Aprende desde cero a manejar tráileres con seguridad. Incluye fundamentos teóricos y prácticas supervisadas.',
                    'avance_porcentaje' => 45.50,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } else {
                $cursos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'nombre_curso' => 'Curso Avanzado de Maniobras con Tráiler',
                    'descripcion' => 'Perfecciona tus habilidades con maniobras complejas y técnicas avanzadas de conducción.',
                    'avance_porcentaje' => 20.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('cursos')->insert($cursos);
    }
}
