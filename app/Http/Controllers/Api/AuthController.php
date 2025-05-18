<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
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

        return $this->success([
            'token' => $token, 
            'expires_in' => $this->authService->getTTL()
        ], 'User created successfully', 201);
    }

    public function login(LoginRequest $request) {
        $token = $this->authService->login($request->validated());

        if (!$token) {
            return $this->error([], 'Invalid credentials', 401);
        }

        return $this->success([
            'token' => $token, 
            'expires_in' => $this->authService->getTTL()
        ], 'Login successfully', 200);
    }

    public function me() {
        $user = $this->authService->getUser();
        $user = $this->userService->showUser($user->id);
        
        return $this->success(['user' => new UserResource($user)], 'User details', 200);
    }

    public function logout() {
        $this->authService->logout();
        return $this->success([], 'Logout successfully', 200);
    }
}
