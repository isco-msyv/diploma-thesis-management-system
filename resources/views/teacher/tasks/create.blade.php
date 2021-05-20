@extends('layout')

@section('title', 'Tasks | Create')

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
                            <h4 class="card-title">Create</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('teacher.tasks.store') }}">
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
                                                <button type="submit" class="btn btn-primary shadow">Save</button>
                                            </div>

                                        </div>
                                    </div>
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
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            let dataProject = '@json(old('project_id'))';
            dataProject = JSON.parse(dataProject);

            let selectProject = $("#item-project");
            selectProject.val(dataProject);
            selectProject.trigger('change');
            selectProject.select2({
                placeholder: "select a project",
                allowClear: true
            });
        });
    </script>
@endsection
