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

    public function getUser() {
        return Auth::user();
    }

    public function getId() {
        return Auth::id();
    }
}
