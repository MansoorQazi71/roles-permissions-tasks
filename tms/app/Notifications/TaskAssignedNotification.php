<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAssignedNotification extends Notification
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
        // Define your email content here
        return (new MailMessage)
            ->line('You have been assigned a new task.')
            ->action('View Task', route('tasks.show', $this->task->id))
            ->line('Thank you!');
    }
}
