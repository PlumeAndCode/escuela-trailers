<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Tareas Programadas
|--------------------------------------------------------------------------
|
| Las siguientes tareas se ejecutan automáticamente según su horario.
| Para activar el scheduler, configura un cron job:
| * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
|
*/

// Marcar pagos vencidos diariamente a medianoche
Schedule::command('pagos:marcar-vencidos')->daily()->at('00:00');
