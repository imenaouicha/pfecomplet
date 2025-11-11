<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateEmploye
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('employe')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
