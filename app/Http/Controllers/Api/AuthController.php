<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;
    protected $authService;

    public function __construct() {
        $this->userService = new UserService();
        $this->authService = new AuthService();
    }

    public function register(RegisterRequest $request) {
        $user = $this->userService->createUser($request->all());

        if ($user['status'] !== 200) {
            return response()->json($user['data'], $user['status']);
        }

        $token = $this->authService->register($user['data']['user']);
        return response()->json($token['data'], $token['status']);
    }

    public function login(LoginRequest $request) {
        $response = $this->authService->login($request->all());
        return response()->json($response['data'], $response['status']);
    }

    public function me() {
        $user = $this->authService->me();
        return response()->json($user['data'], $user['status']);
    }

    public function logout() {
        $logout = $this->authService->logout();
        return response()->json($logout['data'], $logout['status']);
    }
}
