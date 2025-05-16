<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Exception;

class UserService
{
    protected $userRepository;
    
    /**
     * Create a new class instance.
     */
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $request) {
        try {
            $user = $this->userRepository->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
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
