<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LeccionesIndividualesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener contrataciones de tipo lección
        $serviciosLeccion = DB::table('servicios')
            ->where('tipo_servicio', 'leccion')
            ->pluck('id');
        
        $contratacionesLeccion = DB::table('contrataciones')
            ->whereIn('id_servicio', $serviciosLeccion)
            ->get();
        
        if ($contratacionesLeccion->isEmpty()) {
            $this->command->warn('No hay contrataciones de lecciones para crear lecciones individuales.');
            return;
        }

        $leccionesIndividuales = [];
        
        foreach ($contratacionesLeccion as $index => $contratacion) {
            if ($contratacion->estado_contratacion === 'activo') {
                $leccionesIndividuales[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_programada' => Carbon::now()->addDays(2)->setTime(10, 0),
                    'estado_leccion' => 'pendiente',
                    'observaciones' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $leccionesIndividuales[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_programada' => Carbon::now()->subDays(3)->setTime(14, 0),
                    'estado_leccion' => 'vista',
                    'observaciones' => 'El estudiante mostró buen dominio del volante y realizó correctamente las maniobras.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } elseif ($contratacion->estado_contratacion === 'finalizado') {
                $leccionesIndividuales[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_programada' => Carbon::now()->subDays(5)->setTime(9, 0),
                    'estado_leccion' => 'pagada',
                    'observaciones' => 'Lección completada exitosamente. El estudiante demostró habilidades satisfactorias.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($leccionesIndividuales)) {
            DB::table('lecciones_individuales')->insert($leccionesIndividuales);
        }
    }
}
