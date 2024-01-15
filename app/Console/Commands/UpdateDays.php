<?php

namespace App\Console\Commands;

use App\Models\Suscripcion\Suscripcion;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateDays extends Command
{

    protected $signature = 'update:days';

    protected $description = 'Command description';


    public function handle()
    {
        $newDate = Carbon::now()->format('Y-m-d');
        $suscripciones = Suscripcion::with('tipos')->get();
        foreach ($suscripciones as $suscripcion) {

            $fechaInicio = Carbon::createFromDate($suscripcion->fecha_inicio);
            $fechaFin = Carbon::createFromDate($newDate);
            $diferenciaEnDias = $fechaInicio->diffInDays($fechaFin);
            $resultado = $suscripcion->tipos->dias - $diferenciaEnDias;
            Suscripcion::where('id', $suscripcion->id)->update(['dias' => $resultado]);
        }
    }
}
