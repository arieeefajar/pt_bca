<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        // dd(env('PYTHON_END_POINT'));
        // $data = Carbon::now()->format('d/n/Y H:i:s');
        // dd($data);
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        // custom message validate
        $customMessages = [
            'nip.required' => 'NIP harus diisi.',
            'password.required' => 'Password harus diisi.',
        ];

        // validate
        $validator = Validator::make(
            $request->all(),
            [
                'nip' => 'required',
                'password' => 'required',
            ],
            $customMessages
        );

        if ($validator->fails()) {
            // example toast
            toast($validator->messages()->all()[0], 'warning')
                ->position('top')
                ->autoClose(3000);
            return redirect()
                ->back()
                ->withInput();
        }

        // cek email
        $user = User::where('nip', $request->nip)->first();
        if (!$user) {
            toast('NIP tidak terdaftar', 'error')
                ->position('top')
                ->autoClose(3000);
            return redirect()
                ->back()
                ->withInput();
        }

        // Validasi berhasil, lanjutkan dengan percobaan otentikasi
        $credentials = $request->only('nip', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            $user = Auth::user();

            if ($user->role == 'supper-admin') {
                toast('Login berhasil', 'success')
                    ->position('top')
                    ->autoClose(3000);
                return redirect()->route('superAdmin.dashboard');
            } elseif ($user->role == 'admin') {
                toast('Login berhasil', 'success')
                    ->position('top')
                    ->autoClose(3000);
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'executive') {
                toast('Login berhasil', 'success')
                    ->position('top')
                    ->autoClose(3000);
                return redirect()->route('executive.dashboard');
            } elseif ($user->role == 'user') {
                toast('Login berhasil', 'success')
                    ->position('top')
                    ->autoClose(3000);
                return redirect()->route('surveyor.dashboard');
            }

            abort(403, 'Unauthorized');
        } else {
            // Login gagal
            toast('Email atau password salah', 'error')
                ->position('top')
                ->autoClose(3000);
            return back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        // dd(Auth::check());
        if (Auth::check()) {
            // Hapus cookie selectedTokoId
            Cookie::queue(Cookie::forget('selectedTokoId'));
            Cookie::queue(Cookie::forget('kategoriToko'));

            //function logout
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/')->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');;
    }

    public function clearSelectedTokoCookie()
    {
        Cookie::queue(Cookie::forget('selectedTokoId'));
        Cookie::queue(Cookie::forget('kategoriToko'));
        return redirect('/surveyor-dashboard');
    }

    public function lupaPassword()
    {
        return view('auth.lupaPassword');
    }
}
