<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Repositories\ProjectRepository;
use App\Services\AuthService;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;
    protected $authService;

    public function __construct() {
        $this->projectService = new ProjectService(new ProjectRepository());
        $this->authService = new AuthService();
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
}
