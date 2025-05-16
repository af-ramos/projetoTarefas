<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->user = new User();
    }

    public function create(array $data) {
        return $this->user::create($data);
    }
}
