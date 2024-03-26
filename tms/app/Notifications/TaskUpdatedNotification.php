<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TaskUpdatedNotification extends Notification
{
    use Queueable;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can add other channels here like database, slack, etc.
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->line('The task "' . $this->task->title . '" has been updated.')
            ->action('View Task', route('tasks.show', $this->task->id))
            ->line('Thank you!');
    }

    // You can also define other notification channels and methods like toDatabase(), toSlack(), etc. if needed.
}
