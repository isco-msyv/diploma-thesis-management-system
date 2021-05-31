<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpdate;
use App\Mail\ProjectCompleted;
use App\Mail\ProjectRejected;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('student')
            ->where('teacher_id', '=', auth()->user()->id)
            ->has('student')
            ->when($request->query('search'), function ($query) use ($request) {
                $search = $request->query('search');
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(20);

        return view('teacher.projects.index', ['projects' => $projects]);
    }

    public function edit(Project $project)
    {
        if ($project->teacher_id != auth()->user()->id) {
            return redirect()->route('teacher.projects.index');
        }

        $project->load(['tasks', 'student']);

        $completed = 0;
        foreach ($project->tasks as $task) {
            if ($task->status) {
                $completed++;
            }
        }

        $progress = $completed === 0 ? 0 : intval($completed * 100 / $project->tasks->count());

        return view('teacher.projects.edit', ['project' => $project, 'progress' => $progress]);
    }

    public function update(ProjectUpdate $request, Project $project)
    {
        $validated = $request->validated();

        $project->update($validated);

        return back()->with(['toast-type' => 'success', 'message' => 'Project updated!']);
    }

    public function destroy(Project $project)
    {
        if ($project->teacher_id !== auth()->user()->id) {
            return redirect()->route('teacher.projects.index');
        }

        try {
            $project->delete();
        } catch (Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return redirect()->route('teacher.projects.index')->with(['toast-type' => 'success', 'message' => 'Project deleted!']);
    }

    public function download(Project $project)
    {
        return Storage::disk('public')->download($project->artefact);
    }

    public function complete(Project $project)
    {
        $project->update(['status' => ProjectStatus::COMPLETED]);

        Mail::to($project->student->email)->send(new ProjectCompleted($project));

        return back()->with(['toast-type' => 'success', 'message' => 'Project completed!']);
    }

    public function reject(Project $project)
    {
        $project->update(['status' => ProjectStatus::IN_PROGRESS]);

        Mail::to($project->student->email)->send(new ProjectRejected($project));

        return back()->with(['toast-type' => 'warning', 'message' => 'Project rejected!']);
    }
}
