<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->model = new Task();
    }

    public function list() {
        return $this->model->with(['user:id,name', 'status:id,description'])->get();
    }

    public function show(int $id) {
        return $this->model->with(['user:id,name', 'status:id,description', 'project:id,title,user_id'])->find($id);
    }
}
