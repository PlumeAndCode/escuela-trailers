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
     * Cada cliente tiene de 0 a 3 contrataciones
     */
    public function run(): void
    {
        // Obtener SOLO usuarios con rol 'cliente'
        $clientes = DB::table('users')
            ->where('rol', 'cliente')
            ->pluck('id')
            ->toArray();
        
        $servicios = DB::table('servicios')->get()->groupBy('tipo_servicio');
        
        if (empty($clientes)) {
            $this->command->warn('No hay clientes disponibles para crear contrataciones.');
            return;
        }

        $contrataciones = [];
        $estados = ['pendiente', 'activo', 'finalizado'];
        
        // Obtener servicios por tipo
        $serviciosCurso = $servicios->get('curso', collect());
        $serviciosLeccion = $servicios->get('leccion', collect());
        $serviciosLicencia = $servicios->get('licencia', collect());
        $serviciosRenta = $servicios->get('renta_trailer', collect());
        
        // Todos los servicios disponibles para selección aleatoria
        $todosServicios = collect();
        if ($serviciosCurso->isNotEmpty()) $todosServicios = $todosServicios->merge($serviciosCurso);
        if ($serviciosLeccion->isNotEmpty()) $todosServicios = $todosServicios->merge($serviciosLeccion);
        if ($serviciosLicencia->isNotEmpty()) $todosServicios = $todosServicios->merge($serviciosLicencia);
        if ($serviciosRenta->isNotEmpty()) $todosServicios = $todosServicios->merge($serviciosRenta);
        
        if ($todosServicios->isEmpty()) {
            $this->command->warn('No hay servicios disponibles para crear contrataciones.');
            return;
        }

        // Contadores para estadísticas
        $totalContrataciones = 0;
        $clientesSinContratacion = 0;
        
        // Para cada cliente, crear entre 0 y 3 contrataciones
        foreach ($clientes as $index => $clienteId) {
            // Número aleatorio de contrataciones (0 a 3)
            $numContrataciones = rand(0, 3);
            
            if ($numContrataciones === 0) {
                $clientesSinContratacion++;
                continue;
            }
            
            // Seleccionar servicios aleatorios para este cliente
            $serviciosSeleccionados = $todosServicios->random(min($numContrataciones, $todosServicios->count()));
            
            // Si solo se seleccionó uno, convertirlo a colección
            if (!($serviciosSeleccionados instanceof \Illuminate\Support\Collection)) {
                $serviciosSeleccionados = collect([$serviciosSeleccionados]);
            }
            
            foreach ($serviciosSeleccionados as $servicio) {
                // Asignar estado según la antigüedad (variedad)
                $diasAtras = rand(1, 120);
                
                // Estados más probables según antigüedad
                if ($diasAtras > 90) {
                    $estado = 'finalizado';
                } elseif ($diasAtras > 30) {
                    $estado = rand(0, 1) ? 'activo' : 'finalizado';
                } elseif ($diasAtras > 7) {
                    $estado = rand(0, 1) ? 'activo' : 'pendiente';
                } else {
                    $estado = rand(0, 2) === 0 ? 'activo' : 'pendiente';
                }
                
                $contrataciones[] = [
                    'id' => Str::uuid(),
                    'id_usuario' => $clienteId,
                    'id_servicio' => $servicio->id,
                    'fecha_contratacion' => Carbon::now()->subDays($diasAtras),
                    'estado_contratacion' => $estado,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $totalContrataciones++;
            }
        }

        // Insertar todas las contrataciones
        if (!empty($contrataciones)) {
            DB::table('contrataciones')->insert($contrataciones);
        }
        
        $this->command->info("✅ Contrataciones creadas: {$totalContrataciones} para " . (count($clientes) - $clientesSinContratacion) . " clientes");
        $this->command->info("📊 {$clientesSinContratacion} cliente(s) sin contrataciones (0 servicios)");
    }
}
