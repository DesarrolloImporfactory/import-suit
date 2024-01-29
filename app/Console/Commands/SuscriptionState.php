<?php

namespace App\Console\Commands;

use App\Models\Suscripcion\Suscripcion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SuscriptionState extends Command
{

    protected $signature = 'suscription:state';

    protected $description = 'Verifica la actividad de la suscripcion por la fecha de fin';


    public function handle()
    {
        $newDate = Carbon::now()->format('Y-m-d');
        $suscripciones = Suscripcion::all();
        foreach ($suscripciones as $suscripcion) {
            if ($suscripcion->dias > 0) {
                $suscripcion->decrement('dias');
            } else {
                Suscripcion::where('id', $suscripcion->id)->update(['Estado' => 'Caducada']);
                //pasar al usuario a la suscripcion de prueba
                $user = User::where('id', $suscripcion->usuario_id)->first();
                Suscripcion::where('usuario_id', $user->id)->update(['Estado' => 'Caducada']);
                $user->syncRoles([3]);
            }
        }
    }
}
