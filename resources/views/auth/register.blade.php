@extends('auth.layout')

@section('title', 'Register - ' . env('APP_NAME'))

@section('content')
    <!-- register page start -->
    <section id="auth-register" class="row flexbox-container">
        <div class="col-xl-8 col-11">
            <div class="card bg-authentication mb-0">
                <div class="row m-0">
                    <!-- left section-register -->
                    <div class="col-md-6 col-12 px-0">
                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="text-center mb-2">Register</h4>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="text-bold-600" for="inputFullName">Full Name</label>
                                            <input name="full_name"
                                                   value="{{old('full_name')}}"
                                                   type="text"
                                                   class="form-control @error('full_name') is-invalid @enderror"
                                                   id="inputFullName"
                                                   placeholder="Full Name">
                                            @error('full_name')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold-600" for="inputEmail">Email</label>
                                            <input name="email"
                                                   value="{{old('email')}}"
                                                   type="text"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="inputEmail"
                                                   placeholder="Email">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold-600" for="inputPassword">Password</label>
                                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold-600" for="inputPasswordConfirmation">Confirm Password</label>
                                            <input name="password_confirmation"
                                                   type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   id="inputPasswordConfirmation"
                                                   placeholder="Confirm Password">
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold-600">Type</label>
                                            <div>
                                                <fieldset class="d-inline">
                                                    <div class="radio">
                                                        <input type="radio" name="type" id="radio1" value="{{ UserType::TEACHER }}" checked>
                                                        <label for="radio1">{{ UserType::TEACHER }}</label>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="d-inline ml-2">
                                                    <div class="radio">
                                                        <input type="radio" name="type" id="radio2" value="{{ UserType::STUDENT }}">
                                                        <label for="radio2">{{ UserType::STUDENT }}</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            @error('type')
                                            <div class="invalid-feedback d-block">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary glow w-100 position-relative">
                                            Register<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                        </button>
                                        <p class="mt-2">
                                            Already have an account?
                                            <a href="{{ route('login.form') }}">Login</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- right section image -->
                    <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                        <div class="card-content">
                            <img class="img-fluid" src="{{ asset('frest/assets/images/login.png') }}" alt="branding logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- register page ends -->
@endsection
