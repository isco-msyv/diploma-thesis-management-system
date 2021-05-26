<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpdate;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
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

        return view('teacher.projects.edit', ['project' => $project]);
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

        return back()->with(['toast-type' => 'success', 'message' => 'Project completed!']);
    }
}
