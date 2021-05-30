<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\ProjectRequestSent;
use App\Models\Project;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = Project::with(['teacher'])
            ->doesntHave('request')
            ->doesntHave('student')
            ->when($request->query('search'), function ($query) use ($request) {
                $search = $request->query('search');
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(20);

        return view('student.topics.index', ['topics' => $topics]);
    }

    public function show($id)
    {
        $topic = Project::with(['teacher', 'tasks'])->doesntHave('request')->doesntHave('student')->findOrFail($id);

        return view('student.topics.show', [
            'topic' => $topic
        ]);
    }

    public function apply($id)
    {
        $topic = Project::with(['teacher'])->doesntHave('request')->doesntHave('student')->findOrFail($id);

        ProjectRequest::create([
            'project_id' => $topic->id,
            'student_id' => auth()->user()->id
        ]);

        Mail::to($topic->teacher->email)->send(new ProjectRequestSent($topic));

        return redirect()->route('student.project.show')->with(['toast-type' => 'success', 'message' => 'Project request sent!']);
    }
}
