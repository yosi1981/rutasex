<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Cita;
use App\Anuncio;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
   protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
  
    })->everyMinute();
}

public function prueba()
{
               $provincias = DB::table('provincias')
                ->join('users', 'provincias.idresponsable', '=', 'users.id')
                ->select('provincias.idprovincia', 'provincias.nombre', 'provincias.idresponsable', 'users.name as NombreUsuario', 'provincias.habilitado')
                ->where('provincias.nombre', 'LIKE', '%' . $query . '%')
                ->orderBy('provincias.nombre', 'asc')
                ->paginate(5);
}
    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
