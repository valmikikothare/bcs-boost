@extends('layouts.auth_layout')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('auth.reset_password') }}</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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

            <div class="row">
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-primary btn-block">{{ __('auth.send_password_reset_link') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
@endsection
