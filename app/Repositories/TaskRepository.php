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


    public function listInProject(int $projectId, array $with = []) {
        return $this->model->with($with)->where('project_id', $projectId)->get();
    }
}
