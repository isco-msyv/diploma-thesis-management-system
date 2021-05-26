<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function complete($id)
    {
        $data = auth()->user()->studentProject->id;

        $task = Task::where('project_id', '=', $data)->findOrFail($id);

        $task->update(['status' => 1]);

        return back()->with(['toast-type' => 'success', 'message' => 'Task completed!']);
    }
}
