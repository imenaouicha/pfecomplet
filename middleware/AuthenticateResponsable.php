<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateResponsable
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('responsable')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
