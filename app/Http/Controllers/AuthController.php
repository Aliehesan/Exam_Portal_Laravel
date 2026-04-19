<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (\Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Force redirect based on role (ignore intended URL to ensure correct dashboard)
            $role = strtolower(trim(\Auth::user()->role));
            if ($role === 'admin' || $role === 'faculty') {
                return redirect('/dashboard');
            }
            return redirect('/user-dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
