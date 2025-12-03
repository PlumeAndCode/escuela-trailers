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
     * Crea pagos con variedad: pagados, pendientes y vencidos
     */
    public function run(): void
    {
        // Obtener todas las contrataciones con precio del servicio
        $contrataciones = DB::table('contrataciones')
            ->join('servicios', 'contrataciones.id_servicio', '=', 'servicios.id')
            ->select('contrataciones.*', 'servicios.precio', 'servicios.nombre_servicio')
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
            
            if ($contratacion->estado_contratacion === 'finalizado') {
                // ========================================
                // CONTRATACIÓN FINALIZADA = PAGO COMPLETADO
                // ========================================
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
                // ========================================
                // CONTRATACIÓN ACTIVA = VARIEDAD DE PAGOS
                // ========================================
                
                // Primer pago completado
                $pagos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDay(),
                    'monto_pagado' => $montoPagado * 0.4, // 40% inicial
                    'tipo_pago' => $tipoPago,
                    'estado_pago' => 'pagado',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                // Segundo pago - algunos pagados, otros pendientes
                if ($index % 3 === 0) {
                    // Pago completado
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::parse($contratacion->fecha_contratacion)->addDays(15),
                        'monto_pagado' => $montoPagado * 0.3, // 30%
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pagado',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    // Tercer pago pendiente (futuro)
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::now()->addDays(10), // Fecha futura
                        'monto_pagado' => $montoPagado * 0.3, // 30% restante
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pendiente',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                } elseif ($index % 3 === 1) {
                    // Pago VENCIDO (fecha pasada sin pagar)
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::now()->subDays(15), // Fecha pasada
                        'monto_pagado' => $montoPagado * 0.3,
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'vencido',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    // Pago pendiente adicional
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::now()->addDays(5),
                        'monto_pagado' => $montoPagado * 0.3,
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pendiente',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                } else {
                    // Pago pendiente próximo a vencer
                    $pagos[] = [
                        'id' => Str::uuid(),
                        'id_contratacion' => $contratacion->id,
                        'fecha_pago' => Carbon::now()->addDays(2), // Casi por vencer
                        'monto_pagado' => $montoPagado * 0.6, // 60% restante
                        'tipo_pago' => $tipoPago,
                        'estado_pago' => 'pendiente',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
            } elseif ($contratacion->estado_contratacion === 'pendiente') {
                // ========================================
                // CONTRATACIÓN PENDIENTE = PAGO PENDIENTE
                // ========================================
                $pagos[] = [
                    'id' => Str::uuid(),
                    'id_contratacion' => $contratacion->id,
                    'fecha_pago' => Carbon::now()->addDays(7), // Una semana para pagar
                    'monto_pagado' => $montoPagado,
                    'tipo_pago' => 'tarjeta',
                    'estado_pago' => 'pendiente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        // ========================================
        // AGREGAR PAGOS VENCIDOS ADICIONALES
        // ========================================
        $contratacionActiva = $contrataciones->where('estado_contratacion', 'activo')->first();
        
        if ($contratacionActiva) {
            // Pago muy vencido (hace 30 días)
            $pagos[] = [
                'id' => Str::uuid(),
                'id_contratacion' => $contratacionActiva->id,
                'fecha_pago' => Carbon::now()->subDays(30),
                'monto_pagado' => 500.00,
                'tipo_pago' => 'efectivo',
                'estado_pago' => 'vencido',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Pago vencido reciente (hace 5 días)
            $pagos[] = [
                'id' => Str::uuid(),
                'id_contratacion' => $contratacionActiva->id,
                'fecha_pago' => Carbon::now()->subDays(5),
                'monto_pagado' => 750.00,
                'tipo_pago' => 'linea',
                'estado_pago' => 'vencido',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($pagos)) {
            DB::table('pagos')->insert($pagos);
            $this->command->info('✅ Pagos creados: pagados, pendientes y vencidos');
        }
    }
}
