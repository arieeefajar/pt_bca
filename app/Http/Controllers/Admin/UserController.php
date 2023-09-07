<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        // make roles array
        $roles = ['supper-admin', 'admin', 'executive', 'user'];

        // call data users where role in roles array and order by asc
        $users = User::whereIn('role', $roles)
            ->orderBy('created_at', 'desc')
            ->get();

        // return view
        return view('admin.user', compact('users'));
    }

    public function create(Request $request)
    {

        $customMessages = [
            'name.required' => 'Username harus di isi',
            'name.max' => 'Username maximal :max karakter',

            'email.required' => 'Email harus di isi',
            'email.email' => 'Email harus menggunakan format email',
            'email.unique' => 'Email sudah digunakan',
            'email.max' => 'Email maximal :max karakter',

            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal :min karakter',

            'alamat.required' => 'Alamat harus di isi',
            'alamat.max' => 'Alamat maximal :max karakter',

            'no_telp.required' => 'No Telepon harus di isi',
            'no_telp.min' => 'No Telepon minimal :min karakter',
            'no_telp.max' => 'No Telepon maximal :max karakter',

            'role.required' => 'Role harus di isi',
            'role.in' => 'Role tidak valid',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users|max:40',
            'password' => 'required|min:8',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|min:11|max:16',
            'role' => 'required|in:supper-admin,admin,executive,user',
        ], $customMessages);

        // check validator data
        if ($validator->fails()) {
            alert()->error('Gagal', $validator->messages()->all()[0]);
            return redirect()->back()->withInput();
        }

        // create new user data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->role = $request->role;

        // execute
        try {
            $user->save();
            alert()->success('Berhasil', 'Berhasil menambahkan data user baru');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back()->withInput();
        }
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
            'role' => 'required|in:supper-admin,admin,executive,user',
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
        $user->role = $request->role;

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

    public function destroy(string $id)
    {

        // get user data from id
        $user = User::find($id);

        // if user data not exists
        if (!$user) {
            alert()->error('Gagal', 'User tidak di temukan');
            return redirect()->route('user.index')->with('error', 'User not found.');
        }

        // execute delete
        try {
            $user->delete();
            alert()->success('Berhasil', 'Berhasil menghapus data user');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Gagal', $th);
            return redirect()->back();
        }
    }
}
