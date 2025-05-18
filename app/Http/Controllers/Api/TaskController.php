<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\EditTaskRequest;
use App\Services\AuthService;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Services\UserService;
use App\Traits\ApiResponderTrait;

class TaskController extends Controller
{
    use ApiResponderTrait;

    protected $taskService;
    protected $projectService;
    protected $authService;

    public function __construct(ProjectService $projectService, TaskService $taskService, AuthService $authService) {
        $this->projectService = $projectService;
        $this->taskService = $taskService;
        $this->authService = $authService;
    }

    public function create(CreateTaskRequest $request, int $projectId) {
        $task = $request->validated();

        $project = $this->projectService->showProject($projectId);
        $user = $this->authService->getId();

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }
        
        $task['project_id'] = $project->id;
        $task['owner_id'] = $user;

        $task = $this->taskService->createTask($task);
        return $this->success(['task' => $task], 'Task created successfully', 201);
    }

    public function list(int $projectId) {
        $project = $this->projectService->showProject($projectId);

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }

        $tasks = $this->taskService->listTasks($project->id);
        return $this->success(['tasks' => $tasks], 'Tasks listed successfully', 200);
    }

    public function show(int $taskId) {
        $task = $this->taskService->showTask($taskId);

        if (!$task) {
            return $this->error([], 'Task not found', 404);
        }

        return $this->success(['task' => $task], 'Task listed successfully', 200);
    }

    public function update(EditTaskRequest $request, int $taskId) {
        $taskRequest = $request->validated();

        $taskModel = $this->taskService->showTask($taskId);
        if (!$taskModel) {
            return $this->error([], 'Task not found', 404);
        }

        $this->authorize('update', $taskModel);

        $task = $this->taskService->updateTask($taskId, $taskRequest);
        return $this->success(['task' => $task], 'Task updated successfully', 200);
    }

    public function delete(int $taskId) {
        $taskModel = $this->taskService->showTask($taskId);
        if (!$taskModel) {
            return $this->error([], 'Task not found', 404);
        }

        $this->authorize('delete', $taskModel);

        $this->taskService->deleteTask($taskId);
        return $this->success([], 'Task deleted successfully', 200);
    }
}
