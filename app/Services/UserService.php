<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data) {
        return $this->userRepository->create([
            'name' => strtoupper($data['name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'notifications' => $data['notifications'] ?? []
        ]);
    }

    public function showUser(int $userId) {
        return $this->userRepository->show($userId, ['notifications:id,description']);
    }

    public function getUserNotifications(int $userId) {
        return $this->userRepository->show($userId, ['notifications:id,description'])->notifications;
    }
}
