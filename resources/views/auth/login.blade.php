@extends('layouts.auth_layout')

@section('content')
<style>
.login-box,
.register-box {
    width: 530px !important;
}

@media (max-width: 768px) {

    .login-box,
    .register-box {
        width: 90%;
        margin: 0 auto;
    }
}

@media (max-width: 480px) {

    .login-box,
    .register-box {
        width: 100%;
        padding: 20px;
    }
}
</style>


<div class="card-body login-card-body">
    <div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>

    <h4 class="login-box-msg">{{ __('auth.login') }}</h4>


    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('auth.email') }}" required autofocus>
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
                placeholder="{{ __('auth.password') }}" required>
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

        <div class="row">
            {{-- <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                        {{ __('auth.remember_me') }}
            </label>
        </div>
</div> --}}


<!-- /.col -->
<div class="col-12">
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary btn-block">{{ __('auth.login') }}</button>
    </div>
</div>

<!-- /.col -->
</div>

</form>
<div class="mt-4 mx-2">
    @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">{{ __('auth.forgot_your_password') }}</a>
    @endif
    <br>
    <p class="text-bold pt-2">
        Don’t have an account? <a href="{{ route('register') }}">Sign Up!</a>
    </p>
    <div class="d-flex justify-content-end">
        <a href="{{ route('home_page') }}" class="btn btn-primary btn-sm">
            {{ __('Back to Home') }}
        </a>
    </div>

</div>





</div>
<!-- /.login-card-body -->
@endsection
