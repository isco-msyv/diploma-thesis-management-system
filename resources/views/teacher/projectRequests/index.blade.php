@extends('layout')

@section('title', 'Project Requests | All')

@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- List Start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-content">
                            <div class="card-body">
                                @if($projectRequests->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>PROJECT</th>
                                                <th>STUDENT</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($projectRequests as $projectRequest)
                                                <tr>
                                                    <td>{{ $projectRequest->id }}</td>
                                                    <td>{{ $projectRequest->project->title }}</td>
                                                    <td>{{ $projectRequest->student->full_name }}</td>
                                                    <td>
                                                        @switch($projectRequest->status)
                                                            @case(ProjectRequestStatus::PENDING)
                                                            <span class="badge badge-warning">
                                                                {{ $projectRequest->status }}
                                                            </span>
                                                            @break

                                                            @case(ProjectRequestStatus::ACCEPTED)
                                                            <span class="badge badge-success">
                                                                {{ $projectRequest->status }}
                                                            </span>
                                                            @break

                                                            @case(ProjectRequestStatus::REJECTED)
                                                            <span class="badge badge-danger">
                                                                {{ $projectRequest->status }}
                                                            </span>
                                                            @break

                                                            @default
                                                            Error
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('teacher.projectRequests.update', $projectRequest) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status">
                                                                @foreach(ProjectRequestStatus::all() as $status)
                                                                    <option value="{{ $status }}" @if($projectRequest->status === $status) selected @endif>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button class="btn btn-secondary shadow ml-3">
                                                                Update
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <span class="mb-1">Showing {{ $projectRequests->firstItem() }} to {{ $projectRequests->lastItem() }} of {{ $projectRequests->total() }} entries</span>
                                            {{ $projectRequests->withQueryString()->links() }}
                                        </div>
                                    </div>
                                @else
                                    <p>No Project Requests</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- List End -->
        </div>
    </div>
@endsection
