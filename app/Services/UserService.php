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
            return $this->userRepository->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
            ]);
        } catch (Exception $e) {
            return null;
        }
    }
}
