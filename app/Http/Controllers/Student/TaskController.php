<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function complete($id)
    {
        $data = auth()->user()->studentProject->id;

        $task = Task::with(['project', 'project.teacher'])->where('project_id', '=', $data)->findOrFail($id);

        $task->update(['status' => 1]);

        Mail::to($task->project->teacher->email)->send(new TaskCompleted($task));

        return back()->with(['toast-type' => 'success', 'message' => 'Task completed!']);
    }
}
