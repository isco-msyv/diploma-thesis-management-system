<?php

namespace App\Http\Controllers\Student;

use App\Helpers\ProjectStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Project;

class ProjectController extends Controller
{
    public function show()
    {
        $user = auth()->user()->load([
            'studentProject',
            'studentProject.teacher',
            'studentProject.tasks',

            'studentProjectRequest',
            'studentProjectRequest.project',
            'studentProjectRequest.project.teacher',
            'studentProjectRequest.project.tasks',
        ]);

        if ($user->studentProject !== null) {
            $project = $user->studentProject;
        } else {
            $project = $user->studentProjectRequest->project;
        }

        return view('student.project.show', ['project' => $project, 'user' => $user]);
    }

    public function submit(Request $request)
    {
        $tasks = auth()->user()->studentProject->tasks;

        foreach ($tasks as $task) {
            if (!$task->status) {
                return back()->with(['toast-type' => 'error', 'message' => 'Finish all the tasks!']);
            }
        }

        $request->validate([
            'artefact' => ['required', 'max:5000', 'mimes:pdf,docx,doc']
        ]);

        $item = $request->file('artefact');
        $fullName = Str::slug($item->getClientOriginalName());
        $extension = $item->getClientOriginalExtension();
        $fileName = pathinfo($fullName, PATHINFO_FILENAME) . '-' . Str::uuid()->getHex() . '.' . $extension;
        $item = Storage::disk('public')->putFileAs('atefacts', $item, $fileName);

        auth()->user()->studentProject->update(['artefact' => $item, 'status' => ProjectStatus::IN_REVIEW]);

        return back()->with(['toast-type' => 'success', 'message' => 'Project submitted!']);
    }

    public function download()
    {
        return Storage::disk('public')->download(auth()->user()->studentProject->artefact);
    }
}
