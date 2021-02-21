<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(!auth()->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'message' => 'Invalid credentials'
            ]);
        }

        return $request->session()->regenerate();
        return response()->json(null, 201);
    }

    public function register(Request $request) {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return response([
            "message" => "registration complete",
            "status" => 201,
        ]);
    }

    public function logout(Request $request) {
        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(null, 201);
    }
}
