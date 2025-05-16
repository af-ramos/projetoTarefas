<?php

namespace App\Services;

use App\Interfaces\ProjectRepositoryInterface;
use Exception;

class ProjectService
{
    protected $projectRepository;
    
    /**
     * Create a new class instance.
     */
    public function __construct(ProjectRepositoryInterface $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    public function createProject(array $data) {
        try {
            $project = $this->projectRepository->create($data);

            return [
                'data' => ['project' => $project],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in creating project'],
                'status' => 500
            ];
        }
    }

    public function listProjects() {
        try {
            $projects = $this->projectRepository->list();

            return [
                'data' => ['projects' => $projects],
                'status' => 200
            ];
        } catch (Exception $e) {
            return [
                'data' => ['message' => 'Error in listing projects'],
                'status' => 500
            ];
        }
    }
}
