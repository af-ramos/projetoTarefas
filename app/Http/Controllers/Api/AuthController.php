<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = Auth::login($user);
        
        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function login(Request $request) {
        $token = Auth::attempt($request->only('email', 'password'));

        if (!$token) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => Auth::user()
        ], 200);
    }

    public function me() {
        return response()->json(['user' => Auth::user()], 200);
    }

    public function logout() {
        Auth::logout();
        return response()->json(['status' => true, 'message' => 'Logout successfully'], 200);
    }
}
