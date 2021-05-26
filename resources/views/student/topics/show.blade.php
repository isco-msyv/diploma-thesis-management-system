@extends('layout')

@section('title', 'Topics | Show')

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
                                <form class="form form-horizontal" method="POST" action="{{ route('student.topics.apply', $topic) }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <!-- Teacher -->
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
                                                           value="{{ $topic->teacher->full_name }}"
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
                                                           value="{{ $topic->title }}"
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
                                                              readonly>{{ $topic->description }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary shadow">Send Request</button>
                                            </div>

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
                                @if($topic->tasks->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>DESCRIPTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($topic->tasks as $task)
                                                <tr>
                                                    <td>{{ $task->id }}</td>
                                                    <td>{{ $task->description }}</td>
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
