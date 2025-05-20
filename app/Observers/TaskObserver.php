<?php

namespace App\Observers;

use App\Models\Task;
use App\Services\Notification\TaskNotificationService;
use App\Services\QueueService;
use App\Services\TaskService;

class TaskObserver
{
    protected TaskService $taskService;
    protected QueueService $queueService;

    public function __construct(TaskService $taskService, QueueService $queueService) {
        $this->taskService = $taskService;
        $this->queueService = $queueService;
    }

    public function created(Task $task): void {
        $this->queueService->sendNotification(TaskNotificationService::class, [
            'target' => $task->project->owner_id,
            'type' => 'task_created',
            'task' => $task
        ]);
    }

    public function updated(Task $task): void {
        if (!$task->wasChanged('assigned_id')) {
            return;
        }

        $notifyUsers = array_filter(array_unique(
            [$task->project->owner_id, $task->owner_id, $task->assigned_id]
        ));

        foreach ($notifyUsers as $target) {
            $this->queueService->sendNotification(TaskNotificationService::class, [
                'target' => $target,
                'type' => 'task_assigned',
                'task' => $task
            ]);
        }
    }
}
