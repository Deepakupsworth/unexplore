<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect('/admin/dashboard')
                : redirect('/user/dashboard');
        }

        return $next($request);
    }
}
