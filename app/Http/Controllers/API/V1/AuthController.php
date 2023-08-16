<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\RoleType;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|min:2|max:255',
            'no_telp' => 'required|string|min:6|max:15',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'alamat' => $validatedData['alamat'],
            'no_telp' => $validatedData['no_telp'],
            'role' => RoleType::USER
        ]);


        $response = [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];

        return $this->singleDataSuccessResponse('Succesfully Registered', $response);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $response = [
                'user' => Auth::user(),
                'token' => Auth::user()->createToken('auth_token')->plainTextToken,
            ];
            return $this->singleDataSuccessResponse('Successfully logged in', $response);
        } else {
            return $this->errorResponse('Email or Password is incorrect', null, 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->singleDataSuccessSaveResponse('Successfully logged out', null);
    }
}
