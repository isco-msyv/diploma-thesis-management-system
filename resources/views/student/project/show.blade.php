@extends('layout')

@section('title', 'Project | Show')

@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Show</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('student.project.submit') }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            @if($user->studentProjectRequest !== null)
                                                <div class="col-md-4">
                                                    <label for="item-request-status">REQUEST STATUS</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <div class="controls">
                                                        <input id="item-request-status"
                                                               class="form-control"
                                                               type="text"
                                                               value="Pending"
                                                               readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($user->studentProjectRequest === null)
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between">
                                                        <span>0%</span>
                                                        <span>100%</span>
                                                    </div>
                                                    <div class="progress progress-bar-primary mb-2 align-items-center">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow=" {{ $progress }}" aria-valuemin=" {{ $progress }}" aria-valuemax="100" style="width: {{ $progress }}%">
                                                            <span>Tasks Completed {{ $progress }}%</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="item-project-status">PROJECT STATUS</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <div class="controls">
                                                        <input id="item-project-status"
                                                               class="form-control"
                                                               type="text"
                                                               value="{{ $project->status }}"
                                                               readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-4">
                                                <label for="item-teacher">TEACHER</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <input id="item-teacher"
                                                           class="form-control"
                                                           type="text"
                                                           name="teacher"
                                                           placeholder="teacher"
                                                           value="{{ $project->teacher->full_name }}"
                                                           readonly>
                                                </div>
                                            </div>

                                            <!-- Title -->
                                            <div class="col-md-4">
                                                <label for="item-title">TITLE</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <input id="item-title"
                                                           class="form-control"
                                                           type="text"
                                                           name="title"
                                                           placeholder="title"
                                                           value="{{ $project->title }}"
                                                           readonly>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="col-md-4">
                                                <label for="item-description">DESCRIPTION</label>
                                                <small class="text-muted">optional</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <textarea id="item-description"
                                                              class="form-control"
                                                              type="text"
                                                              name="description"
                                                              readonly>{{ $project->description }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Artefact -->
                                            <div class="col-md-4">
                                                <label for="item-artefact">ARTEFACT</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="row">
                                                    <div class="col-md-{{ $user->studentProjectRequest === null && ($user->studentProject->status === ProjectStatus::IN_REVIEW || $user->studentProject->status === ProjectStatus::COMPLETED) ? '9' : '12' }} form-group">
                                                        <input id="item-artefact"
                                                               class="form-control  @error('artefact') is-invalid @enderror"
                                                               type="file"
                                                               name="artefact"
                                                               placeholder="artefact"
                                                               required>
                                                        @error('artefact')
                                                        <div class="invalid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    @if($user->studentProjectRequest === null && ($user->studentProject->status === ProjectStatus::IN_REVIEW || $user->studentProject->status === ProjectStatus::COMPLETED))
                                                        <div class="col-md-3">
                                                            <div class="d-flex justify-content-end">
                                                                <a class="btn btn-primary shadow"
                                                                   data-toggle="tooltip"
                                                                   data-placement="top"
                                                                   data-original-title="Download File"
                                                                   href="{{ route('student.project.download') }}">
                                                                    <i class="bx bx-download"></i>
                                                                    Download
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            @if($user->studentProjectRequest === null && $user->studentProject->status !== ProjectStatus::IN_REVIEW && $user->studentProject->status !== ProjectStatus::COMPLETED)
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary shadow">Submit</button>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tasks</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if($project->tasks->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>DESCRIPTION</th>
                                                @if($user->studentProjectRequest === null)
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($project->tasks as $task)
                                                <tr>
                                                    <td>{{ $task->id }}</td>
                                                    <td>{{ $task->description }}</td>
                                                    @if($user->studentProjectRequest === null)
                                                        <td>
                                                            @switch($task->status)
                                                                @case(0)
                                                                <span class="badge badge-warning">
                                                                    NOT COMPLETED
                                                                </span>
                                                                @break

                                                                @case(1)
                                                                <span class="badge badge-success">
                                                                    COMPLETED
                                                                </span>
                                                                @break

                                                                @default
                                                                Error
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @if(!$task->status)
                                                                <form action="{{ route('student.task.complete', $task) }}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <button class="btn btn-icon rounded-circle btn-secondary shadow"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            data-original-title="Complete">
                                                                        <i class="bx bx-check"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>No Tasks</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
