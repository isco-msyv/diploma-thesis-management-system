@extends('layout')

@section('title', 'Users | Edit')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/plugins/forms/validation/form-validation.min.css') }}">
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
                                <form class="form form-horizontal" method="POST" action="{{ route('admin.users.update', $user) }}" novalidate>
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <!-- Full Name -->
                                            <div class="col-md-4">
                                                <label for="item-full-name">FULL NAME</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <input id="item-full-name"
                                                           class="form-control @error('full_name') is-invalid @enderror"
                                                           type="text"
                                                           name="full_name"
                                                           placeholder="full name"
                                                           value="{{ $user->full_name }}"
                                                           readonly>
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
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <input id="item-email"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           type="email"
                                                           name="email"
                                                           placeholder="email"
                                                           value="{{ $user->email }}"
                                                           readonly>
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Type -->
                                            <div class="col-md-4">
                                                <label for="item-type">TYPE</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="controls">
                                                    <input id="item-type"
                                                           class="form-control @error('type') is-invalid @enderror"
                                                           type="text"
                                                           name="type"
                                                           placeholder="type"
                                                           value="{{ $user->type }}"
                                                           readonly>
                                                    @error('type')
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-4">
                                                <label>STATUS</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_verified" value="0">
                                                    <input id="item-status"
                                                           class="custom-control-input"
                                                           type="checkbox"
                                                           name="is_verified"
                                                           value="1"
                                                           @if(old('is_verified', $user->is_verified)) checked @endif>
                                                    <label class="custom-control-label" for="item-status">
                                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                        <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                    </label>
                                                    <span id="item-status-text">
                                                        @if(old('is_verified', $user->is_verified))
                                                            Verified
                                                        @else
                                                            Not Verified
                                                        @endif
                                                    </span>
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

                                <form id="form-delete" action="{{ route('admin.users.delete', $user) }}" method="POST">
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
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frest/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

            $("#item-status").on('change', function () {

                let status = $('#item-status').is(':checked');

                if (status) {
                    $('#item-status-text').text("Verified");
                } else {
                    $('#item-status-text').text("Not Verified");
                }
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
