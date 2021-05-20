@extends('layout')

@section('title', 'Tasks | All')

@section('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/pages/search.min.css') }}">
@endsection

@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Search Bar Start -->
            <section class="search-bar-wrapper">
                <div class="search-bar">
                    <form action="{{ route('teacher.tasks.index') }}" method="GET">
                        <fieldset class="search-input form-group position-relative">
                            <input name="search"
                                   value='{{ request()->query('search') }}'
                                   type="search"
                                   class="form-control rounded-right form-control-lg shadow pl-2"
                                   id="searchbar"
                                   placeholder="Search by description">
                            <button class="btn btn-light-primary search-btn rounded" type="submit">
                                <span class="d-none d-sm-block">Search</span>
                                <i class="bx bx-search d-block d-sm-none"></i>
                            </button>
                        </fieldset>
                    </form>
                </div>
            </section>
            <!-- Search Bar End -->

            <!-- List Start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('teacher.tasks.create') }}" class="btn btn-primary shadow">Create</a>
                        </div>
                        <div class="card-content">
                            @if($tasks->isNotEmpty())
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>PROJECT</th>
                                                <th>DESCRIPTION</th>
                                                <th>ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tasks as $task)
                                                <tr>
                                                    <td>{{ $task->id }}</td>
                                                    <td>{{ $task->project->title }}</td>
                                                    <td>{{ $task->description }}</td>
                                                    <td>
                                                        <a class="btn btn-icon rounded-circle btn-secondary shadow"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           data-original-title="Edit"
                                                           href="{{ route('teacher.tasks.edit', $task) }}">
                                                            <i class="bx bx-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <span class="mb-1">Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} entries</span>
                                            {{ $tasks->withQueryString()->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- List End -->
        </div>
    </div>
@endsection
