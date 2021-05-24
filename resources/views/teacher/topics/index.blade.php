@extends('layout')

@section('title', 'Topics | All')

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
                    <form action="{{ route('teacher.topics.index') }}" method="GET">
                        <fieldset class="search-input form-group position-relative">
                            <input name="search"
                                   value='{{ request()->query('search') }}'
                                   type="search"
                                   class="form-control rounded-right form-control-lg shadow pl-2"
                                   id="searchbar"
                                   placeholder="Search by title or description">
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
                            <a href="{{ route('teacher.topics.create') }}" class="btn btn-primary shadow">Create</a>
                        </div>
                        <div class="card-content">
                            @if($topics->isNotEmpty())
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>TITLE</th>
                                                <th>ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($topics as $topic)
                                                <tr>
                                                    <td>{{ $topic->id }}</td>
                                                    <td>{{ $topic->title }}</td>
                                                    <td>
                                                        <a class="btn btn-icon rounded-circle btn-secondary shadow"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           data-original-title="Edit"
                                                           href="{{ route('teacher.topics.edit', $topic) }}">
                                                            <i class="bx bx-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <span class="mb-1">Showing {{ $topics->firstItem() }} to {{ $topics->lastItem() }} of {{ $topics->total() }} entries</span>
                                            {{ $topics->withQueryString()->links() }}
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
