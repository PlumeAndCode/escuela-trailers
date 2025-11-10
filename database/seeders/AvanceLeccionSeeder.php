<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AvanceLeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener lecciones y sus cursos relacionados
        $lecciones = DB::table('lecciones')
            ->join('cursos', 'lecciones.id_curso', '=', 'cursos.id')
            ->select('lecciones.id as leccion_id', 'lecciones.estado_leccion', 'cursos.id_contratacion')
            ->get();
        
        if ($lecciones->isEmpty()) {
            $this->command->warn('No hay lecciones disponibles para crear avances.');
            return;
        }

        $avances = [];
        
        foreach ($lecciones as $leccion) {
            // Determinar el estado de avance según el estado de la lección
            $estadoAvance = match($leccion->estado_leccion) {
                'completada' => 'pagada',
                'en_progreso' => 'vista',
                'no_iniciada', 'bloqueada' => 'pendiente',
                default => 'pendiente',
            };
            
            $avances[] = [
                'id' => Str::uuid(),
                'id_leccion' => $leccion->leccion_id,
                'id_contratacion' => $leccion->id_contratacion,
                'estado_avance' => $estadoAvance,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('avance_leccion')->insert($avances);
    }
}
