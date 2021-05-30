<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskCompleted extends Mailable
{
    use Queueable, SerializesModels;

    private Task $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.task_completed', [
            'studentFullName' => auth()->user()->full_name,
            'taskDescription' => $this->task->description,
            'projectTitle' => $this->task->project->title,
            'url' => route('teacher.projects.edit', $this->task->project)
        ]);
    }
}
