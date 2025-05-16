<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Services\AuthService;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;
    protected $authService;

    public function __construct(ProjectService $projectService, AuthService $authService) {
        $this->projectService = $projectService;
        $this->authService = $authService;
    }

    public function create(CreateProjectRequest $request) {
        $userId = $this->authService->getId();

        if ($userId['status'] !== 200) {
            return response()->json($userId['data'], $userId['status']);
        }

        $project = $request->all();
        $project['user_id'] = $userId['data']['id'];

        $project = $this->projectService->createProject($project);
        return response()->json($project['data'], $project['status']);
    }

    public function list() {
        $projects = $this->projectService->listProjects();
        return response()->json($projects['data'], $projects['status']);
    }

    public function show($id) {
        $project = $this->projectService->showProject($id);
        return response()->json($project['data'], $project['status']);
    }
}
