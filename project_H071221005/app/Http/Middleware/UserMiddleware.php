<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_admin) {
            return redirect('/homeAdmin'); // Ganti '/admin' dengan rute admin yang sesuai
        }

        return $next($request);

        
    }
}
