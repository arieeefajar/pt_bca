<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin-dashboard');
            } elseif ($user->role === 'supper-admin') {
                return redirect('/supper-dashboard');
            } elseif ($user->role === 'executive') {
                return redirect('/executive-dashboard');
            } elseif ($user->role === 'surveyor') {
                return redirect('/surveyor-dashboard');
            } else {
                return redirect('/');
            }
        } else {
            // Login gagal
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
