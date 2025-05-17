<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Services\AuthService;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Services\UserService;
use App\Traits\ApiResponderTrait;

class TaskController extends Controller
{
    use ApiResponderTrait;

    protected $authService;
    protected $taskService;
    protected $projectService;
    protected $userService;

    public function __construct(AuthService $authService, ProjectService $projectService, TaskService $taskService, UserService $userService) {
        $this->authService = $authService;
        $this->projectService = $projectService;
        $this->userService = $userService;
        $this->taskService = $taskService;
    }

    public function create(CreateTaskRequest $request, int $projectId) {
        $task = $request->validated();
        $project = $this->projectService->showProject($projectId);

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }
        
        $this->authorize('create', $project);
        $task['project_id'] = $project->id;

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
}
