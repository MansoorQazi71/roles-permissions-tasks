<?php
// app/Notifications/TaskAssignedNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Task Assigned')
            ->line('A new task has been assigned to you:')
            ->line('Title: ' . $this->task->title)
            ->line('Description: ' . $this->task->description)
            ->line('Due Date: ' . $this->task->due_date)
            ->action('View Task', url('/tasks/' . $this->task->id));
    }
}
