<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStore;
use App\Http\Requests\ProjectUpdate;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('teacher_id', '=', auth()->user()->id)
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

    public function create()
    {
        return view('teacher.projects.create');
    }

    public function store(ProjectStore $request)
    {
        $validated = $request->validated();

        $validated['teacher_id'] = auth()->user()->id;

        Project::create($validated);

        return redirect()->route('teacher.projects.index')->with(['toast-type' => 'success', 'message' => 'Project created!']);
    }

    public function edit(Project $project)
    {
        if ($project->teacher_id != auth()->user()->id) {
            return redirect()->route('teacher.projects.index');
        }

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
}
