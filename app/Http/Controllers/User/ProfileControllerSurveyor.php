<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;

use function Laravel\Prompts\error;

class ProfileControllerSurveyor extends Controller
{
    public function index()
    {
        return view('surveyor.profile');
    }

    public function ubahPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            alert()->error('Gagal', 'Kata sandi lama tidak sesuai.');
            return redirect()->back();
        }

        $user->password = Hash::make($request->new_password);
        // execute edit
        try {
            $user->save();
            alert()->success('Berhasil', 'Kata sandi berhasil diubah.');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }
}
