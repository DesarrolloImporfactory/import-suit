<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RedirectsController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        if (Auth::check()) {
            $sessionId = $request->session()->getId();
            $otherAppUrl = 'http://194.163.183.231:8090/admin/redirect/' . urlencode($sessionId);
            //$otherAppUrl = 'http://158.220.107.176:8080/admin/redirect/' . urlencode($sessionId);
            return Redirect::away($otherAppUrl);
        } else {
            return 'estamos mal';
        }
    }

    public function infoaduana(Request $request)
    {
        if (Auth::check()) {
            $sessionId = $request->session()->getId();
            // $otherAppUrl = 'http://infoaduana.com/admin/redirect/' . urlencode($sessionId);
            $otherAppUrl = 'http://194.163.183.231:8080/admin/redirect/' . urlencode($sessionId);
            return Redirect::away($otherAppUrl);
        } else {
            return redirect('/login')->with('mensaje', 'Por favor inicie sesión.');
        }
    }

    public function cursos(Request $request)
    {
        if (Auth::check()) {

            $sessionId = $request->session()->getId();
            // $otherAppUrl = 'http://infoaduana.com/admin/redirect/' . urlencode($sessionId);
            $otherAppUrl = 'http://app.imporcomexcorp.com/admin/redirect/' . urlencode($sessionId);
            return Redirect::away($otherAppUrl);
        } else {
            return redirect('/login')->with('mensaje', 'Por favor inicie sesión.');
        }
    }


    public function store(Request $request)
    {
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
