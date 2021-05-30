<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\ProjectStatus;
use App\Helpers\UserType;
use App\Http\Controllers\Controller;
use App\Mail\ProjectRequestAccepted;
use App\Mail\ProjectRequestRejected;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
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
        $projectRequest->load(['project', 'student']);

        if ($projectRequest->project->teacher_id !== auth()->user()->id) {
            return redirect()->route('profile.edit');
        }

        $request->validate([
            'status' => ['required', Rule::in([0, 1])]
        ]);

        $status = $request->get('status');

        $message = "Project Request rejected";

        if ($status) {
            $message = "Project Request accepted";
            $projectRequest->project()->update(['student_id' => $projectRequest->student_id, 'status' => ProjectStatus::IN_PROGRESS]);

            Mail::to($projectRequest->student->email)->send(new ProjectRequestAccepted());

        } else {
            Mail::to($projectRequest->student->email)->send(new ProjectRequestRejected());
        }

        $projectRequest->delete();

        return redirect()->route('teacher.projectRequests.index')->with(['toast-type' => 'success', 'message' => $message]);
    }
}
