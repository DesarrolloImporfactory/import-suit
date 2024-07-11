<?php

namespace App\Http\Controllers\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructoresController extends Controller
{

    public function index()
    {
        return view('constructor');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $subd3 = $request->input("subdominio");
        $oldFile = "/home/imporsuit/public_html/$subd3/sysadmin/vistas/db.php";
        file_put_contents($oldFile, str_replace("imporsuit_alvitorsa", "imporsuit_$subd3", file_get_contents($oldFile)));

        return "Tienda creada";
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
