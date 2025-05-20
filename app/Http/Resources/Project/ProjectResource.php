<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\StatusResource;
use App\Http\Resources\Task\TaskSummaryResource;
use App\Http\Resources\User\UserSummaryResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'owner' => new UserSummaryResource($this->owner),
            'status' => new StatusResource($this->status),
            'tasks' => $this->when($this->tasks->isNotEmpty(), TaskSummaryResource::collection($this->tasks))
        ];
    }
}
