<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    
    
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'mdp' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        // Redirection basée sur le rôle
        if ($user->role === 'administrateur') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'responsable') {
            return redirect()->route('responsable.dashboard');
        } else {
            return redirect()->route('employe.dashboard');
        }
        }

          
        
       
            dd($request->all()); // Vérifie si les données arrivent bien
        
    }
   
}
