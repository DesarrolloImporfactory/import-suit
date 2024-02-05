<?php

use App\Http\Controllers\Constructor\ConstructoresController;
use App\Http\Controllers\RedirectsController;
use App\Http\Livewire\Products\ClientProducts;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


Route::get('/', function () {
    // determinar si el usuario esta autenticado
    if (auth()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});

Auth::routes([
    "register" => false,
    "reset" => true,
    'verify' => false
]);

Route::get('prueba', function () {
    $usuarioAutenticado = Auth::user();
    $rol = $usuarioAutenticado->roles->first();
    return $rol;
});

Route::get('client/products', ClientProducts::class)->name('client.products');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::resource('redirect/app', RedirectsController::class)->names('redirect.app')->middleware('cotizador');
    Route::get('redirect/infoaduana', [RedirectsController::class, 'infoaduana'])->name('redirect.infoaduana')->middleware('infoaduana');
    Route::get('redirect/cursos', [RedirectsController::class, 'cursos'])->name('redirect.cursos')->middleware('cursos');
    Route::resource('constructor', ConstructoresController::class)->names('constructor');
});
