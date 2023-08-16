<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

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

            if ($user->role == 'supper-admin') {
                return redirect()->route('superAdmin.dashboard');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'executive') {
                return redirect()->route('executive.dashboard');
            } elseif ($user->role == 'user') {
                return redirect()->route('surveyor.dashboard');
            }

            abort(403, 'Unauthorized');

        } else {

            // Login gagal
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->withInput();
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
