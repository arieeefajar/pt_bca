<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountToko;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register_toko');
    }

    public function register_store(Request $request)
    {
        $customMessages = [
            'name.required' => 'Nama Toko harus diisi.',
            'name.max' => 'Nama Toko maximal :max karakter',

            'no_telp.required' => 'Nomor Telepon harus diisi.',
            'no_telp.min' => 'No Telepon minimal :min karakter',
            'no_telp.max' => 'No Telepon maximal :max karakter',

            'address.required' => 'Alamat harus diisi.',

            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password Telepon minimal :min karakter',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'no_telp' => 'required|min:11|max:16',
            'address' => 'required|string',
            'password' => 'required|min:8',
        ], $customMessages);

        // check validator data
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        try {
            AccountToko::create([
                'nama_toko' => Str::lower($request->name),
                'no_telp' => $request->no_telp,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);

            alert()->success('Berhasil', 'Berhasil menambahkan data user baru');
            return redirect()->route('loginToko');
        } catch (\Throwable $th) {
            dd($th);
            alert()->error('Gagal', 'Register gagal, silahkan melakukan register ulang');
            return redirect()->back()->withInput();
        }
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

        if (Auth::guard('web')->attempt($credentials)) {
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
            toast('Nip atau password salah', 'error')->position('top')->autoClose(3000);
            return back()->withInput();
        }
    }

    public function prosesLoginSurvey(Request $request){

        // custom message validate
        $customMessages = [
            'no_telp.required' => 'Nomor Telepon harus diisi.',
            'password.required' => 'Password harus diisi.',
        ];

        // validate
        $validator = Validator::make(
            $request->all(),
            [
                'no_telp' => 'required',
                'password' => 'required',
            ],
            $customMessages
        );

        if ($validator->fails()) {
            toast($validator->messages()->all()[0], 'warning')->position('top')->autoClose(3000);
            return redirect()->back()->withInput();
        }

        // cek no telepon
        $user = AccountToko::where('no_telp', $request->no_telp)->first();
        if (!$user) {
            toast('No Telepon tidak terdaftar', 'error')->position('top')->autoClose(3000);
            return redirect()->back()->withInput();
        }

        // Validasi berhasil, lanjutkan dengan percobaan otentikasi
        $credentials = $request->only('no_telp', 'password');

        if (Auth::guard('toko')->attempt($credentials)) {
            // Login berhasil
            $user = Auth::guard('toko')->user();
            toast('Login berhasil', 'success')->position('top')->autoClose(3000);
            return redirect()->route('survey_toko.index');
        } else {
            // Login gagal
            toast('Nip atau password salah', 'error')->position('top')->autoClose(3000);
            return back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        
        if (Auth::check()) {
            $status = true;
        } elseif (Auth::guard('toko')->check()) {
            $status = false;
        }

        if (Auth::check() || Auth::guard('toko')->check()) {
            // Hapus cookie selectedTokoId
            Cookie::queue(Cookie::forget('selectedTokoId'));
            Cookie::queue(Cookie::forget('kategoriToko'));

            //function logout
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($status) {
            return redirect('/')->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
        }
        return redirect('/login/survey')->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
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
