@extends('layouts.auth_layout')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('auth.please_confirm_your_password_before_continuing') }}</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ __('auth.password') }}" required autocomplete="current-password">
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
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-primary btn-block">{{ __('auth.confirm_password') }}</button>
                </div>
            </div>
        </form>
        @if (Route::has('password.request'))
            <p class="mb-1">
                <a href="{{ route('password.request') }}">{{ __('auth.forgot_your_password') }}</a>
            </p>
        @endif
    </div>
@endsection
