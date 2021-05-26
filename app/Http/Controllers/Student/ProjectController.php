<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $request->validate([
            'artefact' => ['required']
        ]);


    }
}
