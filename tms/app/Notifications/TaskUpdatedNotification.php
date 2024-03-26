<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TaskUpdatedNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     *
     * @param Task $task The task that was updated
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    // Other methods of the notification class...
}
