<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool {
        return $user->id === $task->assigned_id || $user->id === $task->owner_id || $user->id === $task->project->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool {
        return $user->id === $task->owner_id || $user->id === $task->project->owner_id;
    }
}
