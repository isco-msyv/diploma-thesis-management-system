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
                                                        <form class="d-inline" action="{{ route('teacher.projectRequests.update', $projectRequest) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="0">
                                                            <button class="btn btn-danger shadow">
                                                                Reject
                                                            </button>
                                                        </form>

                                                        <form class="d-inline" action="{{ route('teacher.projectRequests.update', $projectRequest) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="1">
                                                            <button class="btn btn-success shadow ml-3">
                                                                Accept
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
