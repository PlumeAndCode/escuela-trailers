<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Curso;
use App\Models\Leccion;
use App\Models\AvanceLeccion;

class FixMissingAvanceLeccion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:avance-leccion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea registros de AvanceLeccion faltantes para lecciones de cursos existentes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando lecciones sin AvanceLeccion...');

        $cursosConContratacion = Curso::with(['lecciones', 'contratacion'])->whereNotNull('id_contratacion')->get();

        $creados = 0;

        foreach ($cursosConContratacion as $curso) {
            if (!$curso->contratacion) {
                $this->warn("Curso '{$curso->nombre_curso}' no tiene contratación asociada, saltando...");
                continue;
            }

            foreach ($curso->lecciones as $leccion) {
                // Verificar si ya existe el avance para esta lección y contratación
                $existe = AvanceLeccion::where('id_leccion', $leccion->id)
                    ->where('id_contratacion', $curso->id_contratacion)
                    ->exists();

                if (!$existe) {
                    AvanceLeccion::create([
                        'id_leccion' => $leccion->id,
                        'id_contratacion' => $curso->id_contratacion,
                        'estado_avance' => 'pendiente',
                    ]);
                    $creados++;
                    $this->line("  + Creado avance para: {$leccion->nombre_leccion}");
                }
            }
        }

        $this->info("Proceso completado. Se crearon {$creados} registros de AvanceLeccion.");

        return Command::SUCCESS;
    }
}
