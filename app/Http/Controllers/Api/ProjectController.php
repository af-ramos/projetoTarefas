<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Services\AuthService;
use App\Services\ProjectService;
use App\Traits\ApiResponderTrait;

class ProjectController extends Controller
{
    use ApiResponderTrait;

    protected $projectService;
    protected $authService;

    public function __construct(ProjectService $projectService, AuthService $authService) {
        $this->projectService = $projectService;
        $this->authService = $authService;
    }

    public function create(CreateProjectRequest $request) {
        $project = $request->validated();
        $project['user_id'] = $this->authService->getId();
        $project = $this->projectService->createProject($project);
        
        return $this->success(['project' => $project], 'Project created successfully', 201);
    }

    public function list() {
        $projects = $this->projectService->listProjects();
        return $this->success(['projects' => $projects], 'Projects listed successfully', 200);
    }

    public function show($id) {
        $project = $this->projectService->showProject($id);

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }

        return $this->success(['project' => $project], 'Project listed successfully', 200);
    }
}
