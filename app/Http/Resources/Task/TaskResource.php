<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Project\ProjectSummaryResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\User\UserSummaryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => new StatusResource($this->status),
            'owner' => new UserSummaryResource($this->owner),
            'assigned' => $this->when($this->assigned, new UserSummaryResource($this->assigned)),
            'project' => new ProjectSummaryResource($this->project)	
        ];
    }
}
