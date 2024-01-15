<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ecommerce\ProductosController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('ecommerce.dashboard');
    })->name('ecommerce.dashboard');

    Route::resource('productos', ProductosController::class)->names('ecommerce.productos');

});
