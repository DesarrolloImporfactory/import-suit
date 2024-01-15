<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Suscripcion\Suscripcion;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        // Obtener los roles del usuario
        $roles = $user->roles;
        $rol = $user->roles->first();
        
        if ($rol->name == 'Client' || $rol->name == 'Alumno') {
            $suscripcion = Suscripcion::where('usuario_id', auth()->user()->id)->first();
            if ($suscripcion) {
                $suscripcion = Suscripcion::where('usuario_id', auth()->user()->id)->first();
            } else {
                $suscripcion = 0;
            }
            
        } else {
            $suscripcion = 0;
        }
        return view('home', compact('suscripcion'));
    }

    public function updateProduct(Product $producto){
        return view('admin.productos.show',compact('producto'));
    }
}
