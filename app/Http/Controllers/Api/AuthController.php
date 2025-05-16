<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\UserService;
use App\Traits\ApiResponderTrait;

class AuthController extends Controller
{
    use ApiResponderTrait;

    protected $userService;
    protected $authService;

    public function __construct(UserService $userService, AuthService $authService) {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) {
        $user = $this->userService->createUser($request->validated());
        $token = $this->authService->register($user);

        return $this->success(['token' => $token], 'User created successfully', 201);
    }

    public function login(LoginRequest $request) {
        $token = $this->authService->login($request->validated());

        if (!$token) {
            return $this->error([], 'Invalid credentials', 401);
        }

        return $this->success(['token' => $token], 'Login successfully', 200);
    }

    public function me() {
        $user = $this->authService->me();
        return $this->success(['user' => $user], 'User details', 200);
    }

    public function logout() {
        $this->authService->logout();
        return $this->success([], 'Logout successfully', 200);
    }
}
