<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UserState extends Command
{

    protected $signature = 'users:state';


    protected $description = 'Cambiar de estado al usuario';


    public function handle()
    {
        $newDate = Carbon::now()->subDay(5)->format('Y-m-d');
        //$usuarios = User::where('session','=', $newDate)->get();
        $usuarios = User::all();
        foreach ($usuarios as $usuario) {
            $formattedSession = Carbon::parse($usuario->session)->format('Y-m-d');
            if ($formattedSession <= $newDate) {
                User::where('id', $usuario->id)->update(['estado' => 'Inactivo']);
            }
        }
    }
}
