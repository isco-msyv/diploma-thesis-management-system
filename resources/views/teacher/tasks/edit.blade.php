@extends('layout')

@section('title', 'Tasks | Edit')

@section('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
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
                                <form class="form form-horizontal" method="POST" action="{{ route('teacher.tasks.update', $task) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <!-- Project -->
                                            <div class="col-md-4">
                                                <label for="item-project">PROJECT</label>
                                                <small class="text-muted">required</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <select id="item-project"
                                                            class="select2 form-control @error('project_id') is-invalid @enderror"
                                                            name="project_id"
                                                            required>
                                                        @foreach($projects as $project)
                                                            <option value="{{ $project->id }}">
                                                                {{ $project->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('project_id')
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
                                                <small class="text-muted">required</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <textarea id="item-description"
                                                              class="form-control @error('description') is-invalid @enderror"
                                                              type="text"
                                                              name="description"
                                                              placeholder="description"
                                                              required>{{ old('description', $task->description) }}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
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

                                <form id="form-delete" action="{{ route('teacher.tasks.delete', $task) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-vendor-js')
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function () {

            let dataProject = '@json(old('project_id', $task->project_id))';
            dataProject = JSON.parse(dataProject);

            let selectProject = $("#item-project");
            selectProject.val(dataProject);
            selectProject.trigger('change');
            selectProject.select2({
                placeholder: "select a project",
                allowClear: true
            });

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

        });
    </script>
@endsection
