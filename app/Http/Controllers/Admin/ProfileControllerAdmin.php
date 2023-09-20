<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileControllerAdmin extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update(Request $request, $id)
    {
        $customMessages = [
            'required' => ':attribute harus diisi.',
            'numeric' => ':attribute harus berupa angka.',
            'email' => ':attribute harus menggunakan format email',
            'unique' => 'Email sudah digunakan.',
            'in' => ':attribute tidak valid.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:40',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:16',
        ], $customMessages);

        // check validator data
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back();
        }

        // get user data from id
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;

        // execute edit
        try {
            $user->save();
            alert()->success('Berhasil', 'Berhasil mengubah data user');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }
}
