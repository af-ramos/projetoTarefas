<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthInterface
{
    public function login(array $data);
    public function register(User $user);
    public function logout();
    public function me();
}
