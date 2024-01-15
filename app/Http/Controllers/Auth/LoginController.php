<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectPath()
    {

        $id = auth()->user()->id;
        $newDate = Carbon::now();

        User::where('id', $id)->update(['session' => $newDate]);
        
        User::where('id', $id)->update(['estado' => 'Activo']);

        return '/home';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
