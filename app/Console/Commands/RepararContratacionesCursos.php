<?php

namespace App\Console\Commands;

use App\Models\Contratacion;
use App\Models\Curso;
use App\Models\Leccion;
use Illuminate\Console\Command;

class RepararContratacionesCursos extends Command
{
    protected $signature = 'cursos:reparar-contrataciones';
    protected $description = 'Crea cursos y lecciones para contrataciones de tipo curso que no los tengan';

    public function handle()
    {
        $this->info('Buscando contrataciones de tipo curso sin curso asociado...');

        $contrataciones = Contratacion::with('servicio')
            ->whereHas('servicio', function ($query) {
                $query->where('tipo_servicio', 'curso');
            })
            ->whereDoesntHave('curso')
            ->get();

        if ($contrataciones->isEmpty()) {
            $this->info('No hay contrataciones que reparar.');
            return Command::SUCCESS;
        }

        $this->info("Encontradas {$contrataciones->count()} contrataciones para reparar.");

        foreach ($contrataciones as $contratacion) {
            $this->line("Creando curso para contratación: {$contratacion->id}");

            $curso = Curso::create([
                'id_contratacion' => $contratacion->id,
                'nombre_curso' => $contratacion->servicio->nombre_servicio,
                'descripcion' => $contratacion->servicio->descripcion ?? 'Curso de manejo de tráileres',
                'avance_porcentaje' => 0,
            ]);

            // Crear lecciones predeterminadas
            $leccionesPredeterminadas = [
                ['nombre' => 'Introducción al manejo de tráileres', 'descripcion' => 'Conceptos básicos y seguridad vial'],
                ['nombre' => 'Conocimiento del vehículo', 'descripcion' => 'Partes del tráiler, controles y sistemas'],
                ['nombre' => 'Maniobras básicas', 'descripcion' => 'Arranque, frenado y cambio de velocidades'],
                ['nombre' => 'Maniobras en reversa', 'descripcion' => 'Técnicas de reversa y estacionamiento'],
                ['nombre' => 'Conducción en carretera', 'descripcion' => 'Manejo en diferentes tipos de vías'],
                ['nombre' => 'Conducción defensiva', 'descripcion' => 'Anticipación de riesgos y reacción segura'],
                ['nombre' => 'Práctica de examen', 'descripcion' => 'Simulación del examen práctico de licencia'],
            ];

            foreach ($leccionesPredeterminadas as $leccionData) {
                Leccion::create([
                    'id_curso' => $curso->id,
                    'nombre_leccion' => $leccionData['nombre'],
                    'descripcion' => $leccionData['descripcion'],
                    'estado_leccion' => 'no_iniciada',
                ]);
            }

            $this->info("  ✅ Curso '{$curso->nombre_curso}' creado con 7 lecciones");
        }

        $this->info('✅ Reparación completada.');
        return Command::SUCCESS;
    }
}
