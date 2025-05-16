<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->model = new Project();
    }

    public function list() {
        return $this->model->with(['user:id,name', 'status:id,description'])->get();
    }

    public function show(int $id) {
        return $this->model->with(['user:id,name', 'status:id,description'])->find($id);
    }
}
