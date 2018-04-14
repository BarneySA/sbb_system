<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->role==1) {
            return $next($request);
        } else {
            return redirec('/');
        }
    }
}
