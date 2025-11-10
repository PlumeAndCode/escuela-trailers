<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ContratacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios y servicios existentes
        $usuarios = DB::table('users')->pluck('id')->toArray();
        $servicios = DB::table('servicios')->get()->groupBy('tipo_servicio');
        
        if (empty($usuarios)) {
            $this->command->warn('No hay usuarios disponibles para crear contrataciones.');
            return;
        }

        $contrataciones = [];
        
        // Crear contrataciones de tipo CURSO
        if ($servicios->has('curso')) {
            $servicioCurso = $servicios->get('curso')->first();
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioCurso->id,
                'fecha_contratacion' => Carbon::now()->subDays(30),
                'estado_contratacion' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioCurso->id,
                'fecha_contratacion' => Carbon::now()->subDays(15),
                'estado_contratacion' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Crear contrataciones de tipo LECCION
        if ($servicios->has('leccion')) {
            $servicioLeccion = $servicios->get('leccion')->first();
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioLeccion->id,
                'fecha_contratacion' => Carbon::now()->subDays(5),
                'estado_contratacion' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioLeccion->id,
                'fecha_contratacion' => Carbon::now()->subDays(2),
                'estado_contratacion' => 'finalizado',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Crear contrataciones de tipo LICENCIA
        if ($servicios->has('licencia')) {
            $servicioLicencia = $servicios->get('licencia')->first();
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioLicencia->id,
                'fecha_contratacion' => Carbon::now()->subDays(20),
                'estado_contratacion' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioLicencia->id,
                'fecha_contratacion' => Carbon::now()->subDays(45),
                'estado_contratacion' => 'finalizado',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Crear contrataciones de tipo RENTA_TRAILER
        if ($servicios->has('renta_trailer')) {
            $servicioRenta = $servicios->get('renta_trailer')->first();
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioRenta->id,
                'fecha_contratacion' => Carbon::now()->subDays(3),
                'estado_contratacion' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $servicioRenta->id,
                'fecha_contratacion' => Carbon::now()->subDays(10),
                'estado_contratacion' => 'finalizado',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Contrataciones pendientes
        $primerServicio = DB::table('servicios')->first();
        if ($primerServicio) {
            $contrataciones[] = [
                'id' => Str::uuid(),
                'id_usuario' => $usuarios[array_rand($usuarios)],
                'id_servicio' => $primerServicio->id,
                'fecha_contratacion' => Carbon::now(),
                'estado_contratacion' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('contrataciones')->insert($contrataciones);
    }
}
