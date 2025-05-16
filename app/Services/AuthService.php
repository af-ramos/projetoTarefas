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
                    'data' => ['status' => false, 'message' => 'Unauthorized'],
                    'statusCode' => 401
                ];
            }

            return [
                'data' => ['status' => true, 'token' => $token, 'user' => $this->me()],
                'statusCode' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['status' => false, 'message' => 'Error in authentication'],
                'statusCode' => 500
            ];
        }
    }

    public function register(Authenticatable $user) {
        try {
            $token = Auth::login($user);

            return [
                'data' => ['status' => true, 'token' => $token],
                'statusCode' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['status' => false, 'message' => 'Error in authentication'],
                'statusCode' => 500
            ];
        }
    }

    public function logout() {
        try {
            Auth::logout();

            return [
                'data' => ['status' => true, 'message' => 'Logout successfully'],
                'statusCode' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['status' => false, 'message' => 'Error in logout'],
                'statusCode' => 500
            ];
        }
    }

    public function me() {
        try {
            $user = Auth::user();

            return [
                'data' => ['status' => true, 'user' => $user],
                'statusCode' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['status' => false, 'message' => 'Error in getting user'],
                'statusCode' => 500
            ];
        }
    }
}
