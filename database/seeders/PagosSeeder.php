<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las contrataciones
        $contrataciones = DB::table('contrataciones')
            ->join('servicios', 'contrataciones.id_servicio', '=', 'servicios.id')
            ->select('contrataciones.*', 'servicios.precio')
            ->get();
        
        if ($contrataciones->isEmpty()) {
            $this->command->warn('No hay contrataciones disponibles para crear pagos.');
            return;
        }

        $pagos = [];
        $tiposPago = ['efectivo', 'tarjeta', 'linea'];
        
        foreach ($contrataciones as $index => $contratacion) {
            $tipoPago = $tiposPago[$index % count($tiposPago)];
            $montoPagado = $contratacion->precio;
            
            // Determinar el estado del pago según la contratación
            if ($contratacion->estado_contratacion === 'finalizado') {
                // Contratación finalizada = pago completado
                $pagos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDays(1),
                    'monto_pagado' => $montoPagado,
                    'tipo_pago' => $tipoPago,
                    'estado_pago' => 'pagado',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
            } elseif ($contratacion->estado_contratacion === 'activo') {
                // Contratación activa = puede tener pago parcial o completo
                if ($index % 2 === 0) {
                    // Pago completo
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDays(1),
                        'monto_pagado' => $montoPagado,
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pagado',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                } else {
                    // Pago parcial + pago pendiente
                    $montoParcial = $montoPagado * 0.5;
                    
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDays(1),
                        'monto_pagado' => $montoParcial,
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pagado',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDays(15),
                        'monto_pagado' => $montoParcial,
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pendiente',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
            } elseif ($contratacion->estado_contratacion === 'pendiente') {
                // Contratación pendiente = pago pendiente
                $pagos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDays(3),
                    'monto_pagado' => $montoPagado,
                    'tipo_pago' => 'efectivo',
                    'estado_pago' => 'pendiente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        // Agregar algunos pagos vencidos
        $contratacionesActivas = $contrataciones->where('estado_contratacion', 'activo')->take(2);
        
        foreach ($contratacionesActivas as $contratacion) {
            $pagos[] = [
                'id' => Str::uuid(),
                'id_contratacion' => $contratacion->id,
                'fecha_pago' => Carbon::now()->subDays(30),
                'monto_pagado' => $contratacion->precio * 0.3,
                'tipo_pago' => 'efectivo',
                'estado_pago' => 'vencido',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($pagos)) {
            DB::table('pagos')->insert($pagos);
        }
    }
}
