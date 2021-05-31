<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    private Project $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.project_submitted', [
            'studentFullName' => auth()->user()->full_name,
            'projectTitle' => $this->project->title,
            'url' => route('teacher.projects.edit', $this->project)
        ]);
    }
}
