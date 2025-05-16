<?php

namespace App\Services;

use App\Interfaces\AuthInterface;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface
{
    public function login(array $data) {
        try {
            $token = Auth::attempt($data);

            if (!$token) {
                return [
                    'data' => ['message' => 'Unauthorized'],
                    'status' => 401
                ];
            }

            return [
                'data' => ['token' => $token, 'user' => Auth::user()],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in authentication'],
                'status' => 500
            ];
        }
    }

    public function register(Authenticatable $user) {
        try {
            $token = Auth::login($user);

            return [
                'data' => ['token' => $token],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in authentication'],
                'status' => 500
            ];
        }
    }

    public function logout() {
        try {
            Auth::logout();

            return [
                'data' => ['message' => 'Logout successfully'],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in logout'],
                'status' => 500
            ];
        }
    }

    public function me() {
        try {
            $user = Auth::user();

            return [
                'data' => ['user' => $user],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in getting user'],
                'status' => 500
            ];
        }
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
