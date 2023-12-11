<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected function redirectTo()
{
    if (auth()->user()->is_admin) {
        $redirectTo = RouteServiceProvider::HOME_ADMIN;
        return route('homeAdmin');
    }else{
        $redirectTo = RouteServiceProvider::HOME_USER;
        return route('homeUser');

    }
    
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
