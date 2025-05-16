<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

class UserService
{
    protected $userRepository;
    
    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function createUser(array $data) {
        try {
            $user = $this->userRepository->create([
                'name' => strtoupper($data['name']),
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            return [
                'data' => ['user' => $user],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in creating user'],
                'status' => 500
            ];
        }
    }
}
