<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Exception;

class TaskService
{
    protected $taskRepository;
    
    /**
     * Create a new class instance.
     */
    public function __construct(TaskRepository $projectRepository) {
        $this->taskRepository = $projectRepository;
    }

    public function createTask(array $data) {
        return $this->taskRepository->create($data);
    }

    public function listTasks(int $projectId) {
        return $this->taskRepository->list($projectId);
    }

    public function showTask(int $taskId) {
        return $this->taskRepository->show($taskId);
    }

    public function updateTask(int $taskId, array $data) {
        return $this->taskRepository->update($taskId, $data);
    }

    public function deleteTask(int $taskId) {
        return $this->taskRepository->delete($taskId);
    }
}
