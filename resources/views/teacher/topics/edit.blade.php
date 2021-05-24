@extends('layout')

@section('title', 'Topics | Edit')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/plugins/forms/validation/form-validation.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('teacher.topics.update', $topic) }}" novalidate>
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <!-- Title -->
                                            <div class="col-md-4">
                                                <label for="item-title">TITLE</label>
                                                <small class="text-muted">required</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <input id="item-title"
                                                           class="form-control @error('title') is-invalid @enderror"
                                                           type="text"
                                                           name="title"
                                                           placeholder="title"
                                                           value="{{ old('title', $topic->title) }}"
                                                           maxlength="255"
                                                           data-validation-maxlength-message="Max 255 characters"
                                                           required>
                                                    @error('title')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
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
                                                              class="form-control @error('description') is-invalid @enderror"
                                                              type="text"
                                                              name="description"
                                                              placeholder="description">{{ old('description', $topic->description) }}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Student -->
                                            <div class="col-md-4">
                                                <label for="item-student">STUDENT</label>
                                                <small class="text-muted">optional</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <select id="item-student" class="select2 form-control @error('student_id') is-invalid @enderror" name="student_id" required>
                                                    @foreach($students as $student)
                                                        <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('student_id')
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <!-- Buttons -->
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button id="item-delete" type="button" class="btn btn-danger shadow mr-1">
                                                    <i class="bx bx-trash"></i>
                                                    Delete
                                                </button>
                                                <button type="submit" class="btn btn-primary shadow">Update</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                                <form id="form-delete" action="{{ route('teacher.topics.delete', $topic) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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
                            <h4 class="card-title">Add New Task</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('teacher.tasks.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <input type="hidden" name="project_id" value="{{ $topic->id }}">

                                            <!-- Description -->
                                            <div class="col-md-4">
                                                <label for="item-description">DESCRIPTION</label>
                                                <small class="text-muted">required</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <textarea id="item-description"
                                                              class="form-control @error('description') is-invalid @enderror"
                                                              type="text"
                                                              name="description"
                                                              placeholder="description"
                                                              required>{{ old('description') }}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Save -->
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary shadow">Add</button>
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
                            @if($topic->tasks->count() > 0)
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>DESCRIPTION</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($topic->tasks as $task)
                                                <tr>
                                                    <td>{{ $task->id }}</td>
                                                    <td>{{ $task->description }}</td>
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
                                                        <form action="{{ route('teacher.tasks.delete', $task) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <button class="btn btn-icon rounded-circle btn-danger shadow delete-task"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Delete">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-vendor-js')
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function () {

            let data = '{{ old('student_id') }}';

            let select = $("#item-student");
            select.val(data);
            select.trigger('change');
            select.select2({
                placeholder: "choose a student",
                allowClear: true,
                closeOnSelect: true
            });

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

            $('#item-delete').on('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete!',
                    confirmButtonClass: 'btn btn-danger',
                    cancelButtonClass: 'btn btn-primary ml-1',
                    buttonsStyling: false,
                }).then(function (result) {
                    if (result.value) {
                        $('#form-delete').submit();
                    }
                })
            });

            $('.select2-container').css('width', '100%');

        });
    </script>
@endsection
