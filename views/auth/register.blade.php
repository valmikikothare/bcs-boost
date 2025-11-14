@extends('layouts.auth_layout')

@section('content')
<style>
    .login-box, .register-box {
        width: 530px !important;
    }

    @media (max-width: 768px) {
        .login-box, .register-box {
            width: 90%;
            margin: 0 auto;
        }
    }

    @media (max-width: 480px) {
        .login-box, .register-box {
            width: 100%;
            padding: 20px;
        }
    }
</style>

<div class="card-body login-card-body">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h4 class="login-box-msg">{{ __('auth.register') }}</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('auth.name') }}" required autocomplete="name" autofocus maxlength="50">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('name')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('auth.email') }}" required autocomplete="email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('auth.password') }}" required autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('auth.confirm_password') }}" required autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-control mb-3">
            <label for="">Which laboratory or office in Building 46 are you associated with?</label>
            <input type="text" name="laboratory_name"
                class="form-control"
                placeholder="Enter here..." required>
        </div>

        <!-- <div class="row my-4 ">
            <div class="col-12">
                <p class="text-center text-bold">Register with:</p>
                <div class="d-flex justify-content-center">
                    <a href="{{ url('login/facebook') }}" class="btn btn-primary rounded-pill  mx-2 ">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ url('login/instagram') }}" class="btn btn-danger mx-2  rounded-pill">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{ url('login/google') }}" class="btn btn-success mx-2  rounded-pill">
                        <i class="fab fa-google"></i>
                    </a>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('auth.register') }}</button>
            </div>

            <div class="col-12">
                <p class="text-bold pt-3">
                    Already Have an Account <a href="{{ route('login') }}">Sign In!</a>
                </p>
            </div>
        </div>

    </form>
</div>
@endsection
