<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;
    protected $authService;

    public function __construct() {
        $this->userService = new UserService(new UserRepository());
        $this->authService = new AuthService();
    }

    public function register(Request $request) {
        $user = $this->userService->createUser($request->all());

        if (!$user) {
            return response()->json([
                'data' => ['status' => false, 'message' => 'Error in registering'],
                'statusCode' => 500
            ]);
        }

        $token = $this->authService->register($user);
        return response()->json($token['data'], $token['statusCode']);
    }

    public function login(Request $request) {
        $response = $this->authService->login($request->only('email', 'password'));
        return response()->json($response['data'], $response['statusCode']);
    }

    public function me() {
        $user = $this->authService->me();
        return response()->json($user['data'], $user['statusCode']);
    }

    public function logout() {
        $logout = $this->authService->logout();
        return response()->json($logout['data'], $logout['statusCode']);
    }
}
