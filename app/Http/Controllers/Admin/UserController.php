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
            ->orderBy('role', 'asc')
            ->get();

        // return view
        return view('admin.user', compact('users'));
    }

    public function create(Request $request)
    {

        $customMessages = [
            'required' => ':attribute harus diisi.',
            'numeric' => ':attribute harus berupa angka.',
            'email' => ':attribute harus menggunakan format email',
            'unique' => 'Email sudah digunakan.',
            'min' => 'Password minimal 8 karakter.',
            'in' => ':attribute tidak valid.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
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
            return redirect()->back();
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
            'no_telp' => 'required|string|max:15',
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
