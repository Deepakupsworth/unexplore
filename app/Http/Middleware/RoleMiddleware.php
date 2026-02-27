<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle($request, Closure $next, $role)
    {
        // print_r(Auth::user());die;
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== $role) {
            //abort(403, 'Unauthorized access');
            return redirect('/')
            ->with('error', __('auth.unauthorized_redirect'));
        }

        return $next($request);
    }
}
