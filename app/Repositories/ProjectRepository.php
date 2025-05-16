<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    protected $project;

    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->project = new Project();
    }

    public function create(array $data) {
        return $this->project::create($data);
    }

    public function list() {
        return $this->project::with(['user:id,name', 'status:id,description'])->get();
    }

    public function show(int $id) {
        return $this->project::with(['user:id,name', 'status:id,description'])->find($id);
    }
}
