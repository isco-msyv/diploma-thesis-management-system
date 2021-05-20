@extends('layout')

@section('title', 'Profile | Edit')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/plugins/forms/validation/form-validation.min.css') }}">
@endsection

@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Profile</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('profile.update') }}" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">

                                            <!-- Full Name -->
                                            <div class="col-md-4">
                                                <label for="item-full-name">FULL NAME</label>
                                                <small class="text-muted">required</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="position-relative has-icon-left controls">
                                                    <input id="item-full-name"
                                                           class="form-control @error('full_name') is-invalid @enderror"
                                                           type="text"
                                                           name="full_name"
                                                           value="{{ old('full_name', auth()->user()->full_name) }}"
                                                           placeholder="Full Name"
                                                           required>
                                                    <div class="form-control-position">
                                                        <i class="bx bx-user"></i>
                                                    </div>
                                                    @error('full_name')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-4">
                                                <label for="item-email">EMAIL</label>
                                                <small class="text-muted">required</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="position-relative has-icon-left controls">
                                                    <input id="item-email"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           type="text"
                                                           name="email"
                                                           value="{{ old('email', auth()->user()->email) }}"
                                                           placeholder="Email"
                                                           required>
                                                    <div class="form-control-position">
                                                        <i class="bx bx-user"></i>
                                                    </div>
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Old Password -->
                                            <div class="col-md-4">
                                                <label for="item-current-password">OLD PASSWORD</label>
                                                <small class="text-muted">optional</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="position-relative has-icon-left controls">
                                                    <input id="item-current-password"
                                                           class="form-control @error('password_old') is-invalid @enderror"
                                                           type="password"
                                                           name="password_old"
                                                           placeholder="Old password"
                                                           minlength="8">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-lock"></i>
                                                    </div>
                                                    @error('password_old')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- New Password -->
                                            <div class="col-md-4">
                                                <label for="item-new-password">NEW PASSWORD</label>
                                                <small class="text-muted">optional</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="position-relative has-icon-left controls">
                                                    <input id="item-new-password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           type="password"
                                                           name="password"
                                                           placeholder="New password"
                                                           minlength="8">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-lock"></i>
                                                    </div>
                                                    @error('password')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Repeat Password -->
                                            <div class="col-md-4">
                                                <label for="item-confirm-password">RETYPE NEW PASSWORD</label>
                                                <small class="text-muted">optional</small>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="position-relative has-icon-left controls">
                                                    <input id="item-confirm-password"
                                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                                           type="password"
                                                           name="password_confirmation"
                                                           placeholder="Retype new password"
                                                           data-validation-match-match="password">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-lock"></i>
                                                    </div>
                                                    @error('password_confirmation')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Update -->
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary shadow">Update</button>
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
    <script src="{{ asset('frest/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function () {

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

        });
    </script>
@endsection
