<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\StatusResource;
use App\Http\Resources\User\UserSummaryResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->when($this->status, new StatusResource($this->status)),
            'assigned' => $this->when($this->assigned, new UserSummaryResource($this->assigned))
        ];
    }
}
