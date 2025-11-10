<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TramitesLicenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener contrataciones de tipo licencia
        $serviciosLicencia = DB::table('servicios')
            ->where('tipo_servicio', 'licencia')
            ->pluck('id');
        
        $contratacionesLicencia = DB::table('contrataciones')
            ->whereIn('id_servicio', $serviciosLicencia)
            ->get();
        
        if ($contratacionesLicencia->isEmpty()) {
            $this->command->warn('No hay contrataciones de licencias para crear trámites.');
            return;
        }

        $tramites = [];
        $tiposLicencia = ['A', 'B', 'C', 'D', 'E'];
        
        foreach ($contratacionesLicencia as $index => $contratacion) {
            $tipoLicencia = $tiposLicencia[$index % count($tiposLicencia)];
            
            $estadoTramite = match($contratacion->estado_contratacion) {
                'activo' => 'proceso',
                'finalizado' => 'completado',
                'pendiente' => 'proceso',
                default => 'proceso',
            };
            
            $tramites[] = [
                'id' => Str::uuid(),
                'id_contratacion' => $contratacion->id,
                'tipo_licencia' => $tipoLicencia,
                'estado_tramite' => $estadoTramite,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tramites_licencia')->insert($tramites);
    }
}
