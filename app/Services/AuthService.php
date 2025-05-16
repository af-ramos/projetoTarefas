<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $data) {
        return Auth::attempt($data);
    }

    public function register(Authenticatable $user) {
        return Auth::login($user);
    }

    public function logout() {
        return Auth::logout();
    }

    public function me() {
        return Auth::user();
    }

    public function getId() {
        try {
            $userId = Auth::id();

            return [
                'data' => ['id' => $userId],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in getting user id'],
                'status' => 500
            ];
        }
    }
}
