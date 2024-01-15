<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Suscripcion\Suscripcion;

class InfoaduanaMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        $usuarioAutenticado = Auth::user();
        $rol = $usuarioAutenticado->roles->first();

        $usuariosConSuscripcionesActivas = Suscripcion::where('estado', 'Activa')
            ->where('usuario_id', $usuarioAutenticado->id)
            ->where('sistema_id', 3)->first();

        if (isset($usuariosConSuscripcionesActivas) || $rol->name == 'Admin' || $rol->name == 'Especialista') {
            return $next($request);
        } else {
            session()->flash('error', 'No tienes suscripciones activas.');
            // abort(403);
            return back();
        }
    }
}
