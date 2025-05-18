<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->model = new User();
    }

    public function create(array $data) {
        $user = parent::create($data);
        // $user->notifications()->attach($data['notifications']);

        return $user;
    }
}
