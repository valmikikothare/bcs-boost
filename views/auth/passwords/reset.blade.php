@extends('layouts.auth_layout')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('auth.reset_password') }}</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

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

            <div class="input-group mb-3">
                <input type="password" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="{{ __('auth.confirm_password') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password_confirmation')
                <span class="error invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('auth.reset_password') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
@endsection
