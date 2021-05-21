<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ProjectRequestStatus;
use App\Helpers\UserType;
use App\Http\Controllers\Controller;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class ProjectRequestController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->type !== UserType::TEACHER) {
            return redirect()->route('profile.edit');
        }

        $projectRequests = ProjectRequest::with(['project', 'student'])
            ->whereHas('project', function (Builder $query) {
                $query->where('teacher_id', '=', auth()->user()->id);
            })
            ->latest()
            ->paginate(20);

        return view('teacher.projectRequests.index', ['projectRequests' => $projectRequests]);
    }

    public function update(Request $request, ProjectRequest $projectRequest)
    {
        $projectRequest->load(['project']);

        if ($projectRequest->project->teacher_id !== auth()->user()->id) {
            return redirect()->route('profile.edit');
        }

        $request->validate([
            'status' => ['required', Rule::in(ProjectRequestStatus::all())]
        ]);

        $status = $request->get('status');

        $projectRequest->update(['status' => $status]);

        return redirect()->route('teacher.projectRequests.index')->with(['toast-type' => 'success', 'message' => 'Project Request updated!']);
    }
}
