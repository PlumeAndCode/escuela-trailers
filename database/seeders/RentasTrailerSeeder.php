<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RentasTrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener contrataciones de tipo renta_trailer
        $serviciosRenta = DB::table('servicios')
            ->where('tipo_servicio', 'renta_trailer')
            ->pluck('id');
        
        $contratacionesRenta = DB::table('contrataciones')
            ->whereIn('id_servicio', $serviciosRenta)
            ->get();
        
        // Obtener tráileres disponibles
        $trailers = DB::table('trailers')->get();
        
        if ($contratacionesRenta->isEmpty() || $trailers->isEmpty()) {
            $this->command->warn('No hay contrataciones de renta o tráileres disponibles.');
            return;
        }

        $rentas = [];
        $trailerIndex = 0;
        
        foreach ($contratacionesRenta as $contratacion) {
            $trailer = $trailers[$trailerIndex % $trailers->count()];
            
            if ($contratacion->estado_contratacion === 'activo') {
                // Renta activa
                $fechaRenta = Carbon::now()->subDays(2);
                $fechaDevolucionEstimada = Carbon::now()->addDays(5);
                
                $rentas[] = [
                    'id' => Str::uuid(),
                    'id_trailer' => $trailer->id,
                    'id_contratacion' => $contratacion->id,
                    'fecha_renta' => $fechaRenta,
                    'fecha_devolucion_estimada' => $fechaDevolucionEstimada,
                    'fecha_devolucion_real' => null,
                    'estado_renta' => 'activa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                // Actualizar estado del tráiler a rentado
                DB::table('trailers')
                    ->where('id', $trailer->id)
                    ->update(['estado_trailer' => 'rentado']);
                    
            } elseif ($contratacion->estado_contratacion === 'finalizado') {
                // Renta devuelta
                $fechaRenta = Carbon::now()->subDays(15);
                $fechaDevolucionEstimada = Carbon::now()->subDays(8);
                $fechaDevolucionReal = Carbon::now()->subDays(8)->addHours(3);
                
                $rentas[] = [
                    'id' => Str::uuid(),
                    'id_trailer' => $trailer->id,
                    'id_contratacion' => $contratacion->id,
                    'fecha_renta' => $fechaRenta,
                    'fecha_devolucion_estimada' => $fechaDevolucionEstimada,
                    'fecha_devolucion_real' => $fechaDevolucionReal,
                    'estado_renta' => 'devuelta',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } elseif ($contratacion->estado_contratacion === 'pendiente') {
                // Renta pendiente de confirmar
                $rentas[] = [
                    'id' => Str::uuid(),
                    'id_trailer' => $trailer->id,
                    'id_contratacion' => $contratacion->id,
                    'fecha_renta' => Carbon::now()->addDays(1),
                    'fecha_devolucion_estimada' => Carbon::now()->addDays(8),
                    'fecha_devolucion_real' => null,
                    'estado_renta' => 'activa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            $trailerIndex++;
        }
        
        // Agregar una renta atrasada (usando un cliente existente)
        if ($trailers->count() > 2 && $contratacionesRenta->isNotEmpty()) {
            $trailerAtrasado = $trailers[2];
            $servicioRentaId = $serviciosRenta->first();
            
            // Obtener SOLO un cliente para la renta atrasada
            $cliente = DB::table('users')->where('rol', 'cliente')->first();
            
            if ($cliente) {
                // Crear contratación para renta atrasada (solo cliente)
                $contratacionAtrasada = [
                    'id' => Str::uuid(),
                    'id_usuario' => $cliente->id,
                    'id_servicio' => $servicioRentaId,
                    'fecha_contratacion' => Carbon::now()->subDays(12),
                    'estado_contratacion' => 'activo',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                DB::table('contrataciones')->insert($contratacionAtrasada);
                
                $rentas[] = [
                    'id' => Str::uuid(),
                    'id_trailer' => $trailerAtrasado->id,
                    'id_contratacion' => $contratacionAtrasada['id'],
                    'fecha_renta' => Carbon::now()->subDays(12),
                    'fecha_devolucion_estimada' => Carbon::now()->subDays(5), // Ya pasó la fecha
                    'fecha_devolucion_real' => null,
                    'estado_renta' => 'atrasada',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                // Marcar tráiler como rentado
                DB::table('trailers')
                    ->where('id', $trailerAtrasado->id)
                    ->update(['estado_trailer' => 'rentado']);
            }
        }

        if (!empty($rentas)) {
            DB::table('rentas_trailer')->insert($rentas);
            $this->command->info('✅ Rentas de tráiler creadas: activas, devueltas y atrasadas');
        }
    }
}
