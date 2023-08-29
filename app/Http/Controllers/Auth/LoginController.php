<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        // dd(Auth::user());
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'supper-admin') {
                return redirect()->route('superAdmin.dashboard')->withErrors('Anda sudah melakukan login sebelumnya');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->withErrors('Anda sudah melakukan login sebelumnya');
            } elseif ($user->role == 'executive') {
                return redirect()->route('executive.dashboard')->withErrors('Anda sudah melakukan login sebelumnya');
            } elseif ($user->role == 'user') {
                return redirect()->route('surveyor.dashboard')->withErrors('Anda sudah melakukan login sebelumnya');
            }
        }

        // custom message validate
        $customMessages = [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berformat @gmail.com.',
            'password.required' => 'Password harus diisi.',
        ];

        // validate
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validasi berhasil, lanjutkan dengan percobaan otentikasi
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $user = Auth::user();

            if ($user->role == 'supper-admin') {
                return redirect()->route('superAdmin.dashboard')->with('success', 'Login berhasil');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            } elseif ($user->role == 'executive') {
                return redirect()->route('executive.dashboard')->with('success', 'Login berhasil');
            } elseif ($user->role == 'user') {
                return redirect()->route('surveyor.dashboard')->with('success', 'Login berhasil');
            }

            abort(403, 'Unauthorized');
        } else {
            // Login gagal
            return back()->withErrors('Login gagal')->withInput();
        }
    }

    public function logout(Request $request)
    {
        // Hapus cookie selectedTokoId
        $response = new \Illuminate\Http\Response(redirect('/'));
        $response->cookie(Cookie::forget('selectedTokoId'));

        //function logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $response;
        // // return view('auth.login');
    }
}
