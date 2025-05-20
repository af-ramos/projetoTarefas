<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function update(User $user, Task $task): bool {
        return $user->id === $task->assigned_id || $user->id === $task->owner_id || $user->id === $task->project->owner_id;
    }

    public function delete(User $user, Task $task): bool {
        return $user->id === $task->owner_id || $user->id === $task->project->owner_id;
    }
}
