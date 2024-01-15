<?php

namespace App\Http\Middleware;

use App\Models\Suscripcion\Suscripcion;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursosMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        $usuarioAutenticado = Auth::user();
        $rol = $usuarioAutenticado->roles->first();

        $usuariosConSuscripcionesActivas = Suscripcion::where('estado', 'Activa')
            ->where('usuario_id', $usuarioAutenticado->id);

        if (isset($usuariosConSuscripcionesActivas) || $rol->name == 'Admin' || $rol->name == 'Especialista') {
            return $next($request);
        } else {
            session()->flash('error', 'No tienes suscripciones activas.');
            // abort(403);
            return back();
        }
    }
}
