<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckResponsable
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and is a responsable
        if (Auth::check() && Auth::user()->role === 'responsable') {
            return $next($request);
        }

        // Redirect to home or login page if not authorized
        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
