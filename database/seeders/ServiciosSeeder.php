<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            // Servicios tipo CURSO
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Curso Básico de Manejo de Tráiler',
                'tipo_servicio' => 'curso',
                'descripcion' => 'Curso completo para aprender a manejar tráileres desde cero. Incluye teoría y práctica con instructor certificado.',
                'precio' => 15000.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Curso Avanzado de Maniobras con Tráiler',
                'tipo_servicio' => 'curso',
                'descripcion' => 'Curso especializado en maniobras complejas, estacionamiento en reversa y conducción en carretera.',
                'precio' => 18500.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Servicios tipo LECCION
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Lección Individual de Manejo',
                'tipo_servicio' => 'leccion',
                'descripcion' => 'Clase práctica individual de 2 horas con instructor certificado y tráiler disponible.',
                'precio' => 1200.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Lección de Estacionamiento en Reversa',
                'tipo_servicio' => 'leccion',
                'descripcion' => 'Sesión especializada de 1.5 horas enfocada en técnicas de estacionamiento en reversa.',
                'precio' => 950.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Servicios tipo LICENCIA
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Trámite de Licencia Tipo C',
                'tipo_servicio' => 'licencia',
                'descripcion' => 'Gestión completa del trámite de licencia tipo C para transporte de carga.',
                'precio' => 3500.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Trámite de Licencia Tipo E',
                'tipo_servicio' => 'licencia',
                'descripcion' => 'Gestión completa del trámite de licencia tipo E para vehículos articulados y tráileres.',
                'precio' => 4200.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Servicios tipo RENTA_TRAILER
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Renta de Tráiler por Día',
                'tipo_servicio' => 'renta_trailer',
                'descripcion' => 'Renta de tráiler por día para prácticas independientes. Incluye seguro básico.',
                'precio' => 2500.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nombre_servicio' => 'Renta de Tráiler por Semana',
                'tipo_servicio' => 'renta_trailer',
                'descripcion' => 'Renta de tráiler por semana completa. Incluye seguro completo y mantenimiento.',
                'precio' => 15000.00,
                'estado_servicio' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('servicios')->insert($servicios);
    }
}
