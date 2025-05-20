<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Exception;

class ProjectService
{
    protected $projectRepository;
    
    public function __construct(ProjectRepository $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    public function createProject(array $data) {
        return $this->projectRepository->create($data);
    }

    public function listProjects() {
        return $this->projectRepository->list(['owner:id,name', 'status:id,description']);
    }

    public function showProject(int $id) {
        return $this->projectRepository->show($id, [
            'tasks:id,project_id,name,assigned_id,status_id', 
            'tasks.assigned:id,name', 
            'tasks.status:id,description',
            'owner:id,name', 
            'status:id,description'
        ]);
    }

    public function updateProject(int $id, array $data) {
        return $this->projectRepository->update($id, $data);
    }

    public function deleteProject(int $id) {
        return $this->projectRepository->delete($id);
    }
}
