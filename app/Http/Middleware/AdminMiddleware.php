<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If not logged in → redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If logged in but not admin → 403 forbidden
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}
