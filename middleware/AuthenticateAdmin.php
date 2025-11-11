<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // 2. Vérifie si son rôle est "administrateur"
        if (Auth::user()->role !== 'administrateur') {
            return redirect()->route('login')->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
