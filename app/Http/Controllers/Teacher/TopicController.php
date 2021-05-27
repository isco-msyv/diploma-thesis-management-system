<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ProjectStatus;
use App\Helpers\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicStore;
use App\Http\Requests\TopicUpdate;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = Project::where('teacher_id', '=', auth()->user()->id)
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

        return view('teacher.topics.index', ['topics' => $topics]);
    }

    public function create()
    {
        $students = User::where('type', '=', UserType::STUDENT)->doesntHave('studentProject')->verified()->get();

        return view('teacher.topics.create', [
            'students' => $students
        ]);
    }

    public function store(TopicStore $request)
    {
        $validated = $request->validated();

        $validated['teacher_id'] = auth()->user()->id;

        if (isset($validated['student_id'])) {
            $validated['status'] = ProjectStatus::IN_PROGRESS;
        }

        $project = Project::create($validated);

        if (isset($validated['student_id'])) {
            return redirect()->route('teacher.projects.edit', $project);
        }

        return redirect()->route('teacher.topics.index')->with(['toast-type' => 'success', 'message' => 'Topic created!']);
    }

    public function edit($id)
    {
        $topic = Project::with(['tasks'])->findOrFail($id);

        if ($topic->teacher_id != auth()->user()->id) {
            return redirect()->route('teacher.topics.index');
        }

        $students = User::where('type', '=', UserType::STUDENT)->doesntHave('studentProject')->verified()->get();

        return view('teacher.topics.edit', [
            'topic' => $topic,
            'students' => $students
        ]);
    }

    public function update(TopicUpdate $request, $id)
    {
        $topic = Project::with(['tasks'])->findOrFail($id);

        $validated = $request->validated();

        if (isset($validated['student_id'])) {
            $validated['status'] = ProjectStatus::IN_PROGRESS;
        }

        $topic->update($validated);

        if (isset($validated['student_id'])) {
            return redirect()->route('teacher.projects.edit', $id);
        }

        return back()->with(['toast-type' => 'success', 'message' => 'Topic updated!']);
    }

    public function destroy($id)
    {
        $topic = Project::with(['tasks'])->findOrFail($id);

        if ($topic->teacher_id !== auth()->user()->id) {
            return redirect()->route('teacher.topics.index');
        }

        try {
            $topic->delete();
        } catch (Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return redirect()->route('teacher.topics.index')->with(['toast-type' => 'success', 'message' => 'Topic deleted!']);
    }
}
