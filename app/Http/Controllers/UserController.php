<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function index()
    {
        $roles = ['supper-admin', 'admin', 'executive', 'surveyor'];
        $users = User::whereIn('role', $roles)
            ->orderBy('role', 'asc')
            ->get();
        return view('admin.user', compact('users'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'role' => 'required|in:supper-admin,admin,executive,surveyor',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->alamat = $request->input('alamat');
        $user->no_telp = $request->input('no_telp');
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'no_telp' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Pengguna Berhasil Dihapus');
    }
}
