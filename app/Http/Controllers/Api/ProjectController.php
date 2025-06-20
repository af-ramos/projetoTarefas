<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\EditProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Project\ProjectSummaryResource;
use App\Services\AuthService;
use App\Services\ProjectService;
use App\Traits\ApiResponderTrait;

class ProjectController extends Controller
{
    use ApiResponderTrait;

    protected ProjectService $projectService;
    protected AuthService $authService;

    public function __construct(ProjectService $projectService, AuthService $authService) {
        $this->projectService = $projectService;
        $this->authService = $authService;
    }

    public function create(CreateProjectRequest $request) {
        $project = $request->validated();
        $project['owner_id'] = $this->authService->getId();

        $project = $this->projectService->createProject($project);
        return $this->success(['project' => new ProjectSummaryResource($project)], 'Project created successfully', 201);
    }

    public function list() {
        $projects = $this->projectService->listProjects();
        return $this->success(['projects' => ProjectSummaryResource::collection($projects)], 'Projects listed successfully', 200);
    }

    public function show($id) {
        $project = $this->projectService->showProject($id);

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }

        return $this->success(['project' => new ProjectResource($project)], 'Project listed successfully', 200);
    }

    public function update(EditProjectRequest $request, int $id) {
        $project = $this->projectService->showProject($id);

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }

        $this->authorize('update', $project);

        $updatedProject = $this->projectService->updateProject($id, $request->validated());
        return $this->success(['project' => new ProjectSummaryResource($updatedProject)], 'Project updated successfully', 200);
    }

    public function delete(int $id) {
        $project = $this->projectService->showProject($id);

        if (!$project) {
            return $this->error([], 'Project not found', 404);
        }

        $this->authorize('delete', $project);

        $this->projectService->deleteProject($id);
        return $this->success([], 'Project deleted successfully', 200);
    }
}
