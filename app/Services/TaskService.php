<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Exception;

class TaskService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $projectRepository) {
        $this->taskRepository = $projectRepository;
    }

    public function createTask(array $data) {
        return $this->taskRepository->create($data);
    }

    public function listTasks(int $projectId) {
        return $this->taskRepository->listInProject($projectId, [
            'owner:id,name', 
            'status:id,description', 
            'assigned:id,name'
        ]);
    }

    public function showTask(int $taskId) {
        return $this->taskRepository->show($taskId, [
            'project:id,title,description,owner_id,status_id', 
            'project.owner:id,name',
            'project.status:id,description',
            'owner:id,name', 
            'status:id,description', 
            'assigned:id,name'
        ]);
    }

    public function updateTask(int $taskId, array $data) {
        return $this->taskRepository->update($taskId, $data);
    }

    public function deleteTask(int $taskId) {
        return $this->taskRepository->delete($taskId);
    }

    public function getProjectOwner(int $taskId) {
        return $this->taskRepository->show($taskId, ['project:id,owner_id']);
    }
}
