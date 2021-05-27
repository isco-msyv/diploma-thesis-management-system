@extends('layout')

@section('title', 'Users | All')

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
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <fieldset class="search-input form-group position-relative">
                            <input name="search"
                                   value='{{ request()->query('search') }}'
                                   type="search"
                                   class="form-control rounded-right form-control-lg shadow pl-2"
                                   id="searchbar"
                                   placeholder="Search by full name or email">
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
                        <div class="card-content">
                            <div class="card-body">
                                @if($users->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>FULL NAME</th>
                                                <th>EMAIL</th>
                                                <th>TYPE</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->full_name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->type }}</td>
                                                    <td>
                                                        @switch($user->is_verified)
                                                            @case(0)
                                                            <span class="badge badge-warning">
                                                                    NOT VERIFIED
                                                                </span>
                                                            @break

                                                            @case(1)
                                                            <span class="badge badge-success">
                                                                    VERIFIED
                                                                </span>
                                                            @break

                                                            @default
                                                            Error
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon rounded-circle btn-secondary shadow"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           data-original-title="Edit"
                                                           href="{{ route('admin.users.edit', $user) }}">
                                                            <i class="bx bx-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <span class="mb-1">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</span>
                                            {{ $users->withQueryString()->links() }}
                                        </div>
                                    </div>
                                @else
                                    <p>No Users</p>
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
