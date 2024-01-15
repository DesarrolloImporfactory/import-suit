<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Livewire\Perfiles\PerfilSuscription;
use App\Http\Livewire\Products\AdminProducts;
use App\Http\Livewire\Products\CreateProduct;
use App\Http\Livewire\Products\UpdateProduct;
use App\Http\Livewire\Suscripcion\UserSuscription;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'can:admin.dashboard'])->group(function () {
    Route::resource('/dashboard', HomeController::class)->names('dashboard');
    Route::resource('/users', UsersController::class)->names('users');
    Route::resource('/roles', RolesController::class)->names('roles');
    Route::get('/suscription', UserSuscription::class)->name('suscription');
    Route::get('/perfiles', PerfilSuscription::class)->name('perfiles');
    Route::get('/products', AdminProducts::class)->name('products')->middleware('can:productos');
    Route::get('/products/create', CreateProduct::class)->name('products.create')->middleware('can:productos');
    Route::get('/products/update/{producto}', [ControllersHomeController::class,'updateProduct'])->name('products.update')->middleware('can:productos');
    Route::get('/categoria-proveedor', function () {
        return view('admin.categoria-proveedor.index');
    })->name('categoria.proveedor');
});
