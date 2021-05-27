@extends('auth.layout')

@section('title', 'Login - ' . env('APP_NAME'))

@section('content')
    <!-- login page start -->
    <section id="auth-login" class="row flexbox-container">
        <div class="col-xl-8 col-11">
            <div class="card bg-authentication mb-0">
                <div class="row m-0">
                    <!-- left section-login -->
                    <div class="col-md-6 col-12 px-0">
                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="text-center mb-2">Welcome Back</h4>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-50">
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
                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                            <div class="text-left">
                                                <div class="checkbox checkbox-sm">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" @if(old('remember')) checked @endif>
                                                    <label class="checkboxsmall" for="exampleCheck1">
                                                        <small>Keep me logged in</small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary glow w-100 position-relative">
                                            Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                        </button>
                                        <p class="mt-2">
                                            Don't have an account?
                                            <a href="{{ route('register.form') }}">Register</a>
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
    <!-- login page ends -->
@endsection
