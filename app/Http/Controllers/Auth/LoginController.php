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

            // example toast
            toast($validator->messages()->all()[0], 'warning')->position('top')->autoClose(3000);
            return redirect()->back()->withInput();
        }
        // Validasi berhasil, lanjutkan dengan percobaan otentikasi
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $user = Auth::user();

            if ($user->role == 'supper-admin') {
                toast('Login berhasil', 'success')->position('top')->autoClose(3000);
                return redirect()->route('superAdmin.dashboard');
            } elseif ($user->role == 'admin') {
                toast('Login berhasil', 'success')->position('top')->autoClose(3000);
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'executive') {
                toast('Login berhasil', 'success')->position('top')->autoClose(3000);
                return redirect()->route('executive.dashboard');
            } elseif ($user->role == 'user') {
                toast('Login berhasil', 'success')->position('top')->autoClose(3000);
                return redirect()->route('surveyor.dashboard');
            }

            abort(403, 'Unauthorized');
        } else {
            // Login gagal
            toast('login gagal', 'error')->position('top')->autoClose(3000);
            return back()->withInput();
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
