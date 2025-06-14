<?php

namespace App\Http\Resources\User;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->whenNotNull($this->email),
            'notifications' => $this->when($this->notifications->isNotEmpty(), NotificationResource::collection($this->notifications))
        ];
    }
}
