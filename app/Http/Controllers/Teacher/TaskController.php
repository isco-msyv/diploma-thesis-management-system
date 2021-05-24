<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TaskController extends Controller
{
//    public function index(Request $request)
//    {
//        $tasks = Task::with(['project'])->whereHas('project', function (Builder $query) {
//            $query->where('teacher_id', '=', auth()->user()->id);
//        })
//            ->when($request->query('search'), function ($query) use ($request) {
//                $search = $request->query('search');
//                $query->where('description', 'like', "%$search%");
//            })
//            ->latest()
//            ->paginate(20);
//
//        return view('teacher.tasks.index', ['tasks' => $tasks]);
//    }

//    public function create()
//    {
//        return view('teacher.tasks.create', ['projects' => Project::where('teacher_id', '=', auth()->user()->id)->get()]);
//    }

    public function store(TaskStore $request)
    {
        $validated = $request->validated();

        Task::create($validated);

//        return redirect()->route('teacher.tasks.index')->with(['toast-type' => 'success', 'message' => 'Task created!']);

        return redirect()->back()->with(['toast-type' => 'success', 'message' => 'Task created!']);
    }

//    public function edit(Task $task)
//    {
//        $task->load(['project']);
//
//        if ($task->project->teacher_id != auth()->user()->id) {
//            return redirect()->route('teacher.tasks.index');
//        }
//
//        return view('teacher.tasks.edit', [
//            'task' => $task,
//            'projects' => Project::where('teacher_id', '=', auth()->user()->id)->get()
//        ]);
//    }

//    public function update(TaskUpdate $request, Task $task)
//    {
//        $validated = $request->validated();
//
//        $task->update($validated);
//
//        return back()->with(['toast-type' => 'success', 'message' => 'Task updated!']);
//    }

    public function destroy(Task $task)
    {
        $task->load(['project']);

        if ($task->project->teacher_id != auth()->user()->id) {
            return redirect()->route('teacher.tasks.index');
        }

        try {
            $task->delete();
        } catch (Exception $exception) {
            abort(500, $exception->getMessage());
        }

//        return redirect()->route('teacher.tasks.index')->with(['toast-type' => 'success', 'message' => 'Task deleted!']);

        return redirect()->back()->with(['toast-type' => 'success', 'message' => 'Task deleted!']);
    }
}
