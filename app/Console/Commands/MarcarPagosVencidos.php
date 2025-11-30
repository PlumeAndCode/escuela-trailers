<?php

namespace App\Console\Commands;

use App\Models\Pago;
use Illuminate\Console\Command;
use Carbon\Carbon;

class MarcarPagosVencidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagos:marcar-vencidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marca como vencidos los pagos pendientes cuya fecha de pago ya pasó';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando pagos pendientes vencidos...');

        $pagosVencidos = Pago::where('estado_pago', 'pendiente')
            ->where('fecha_pago', '<', Carbon::now())
            ->get();

        $cantidad = $pagosVencidos->count();

        if ($cantidad === 0) {
            $this->info('No hay pagos vencidos para actualizar.');
            return Command::SUCCESS;
        }

        $this->info("Encontrados {$cantidad} pagos vencidos. Actualizando...");

        $actualizados = 0;
        foreach ($pagosVencidos as $pago) {
            $pago->update(['estado_pago' => 'vencido']);
            $actualizados++;
            
            // Log para auditoría
            $this->line("  - Pago ID: {$pago->id} marcado como vencido (Fecha: {$pago->fecha_pago->format('d/m/Y')})");
        }

        $this->info("✅ Se actualizaron {$actualizados} pagos a estado 'vencido'.");

        return Command::SUCCESS;
    }
}
