@extends('layouts.admin_main')
@section('content')

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between bg-dark px-4 py-3">
            <div>
                <h4 class="text-white m-0">My Profile</h4>
            </div>
            <div>
                <a class="btn btn-outline-primary" href="{{ route('users.index') }}">{{ __('admin.back') }}</a>
            </div>
        </div>
        <div class="bg-white shadow py-3 px-2">

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('auth.name') }}" value="{{ old('name', auth()->user()->name) }}"
                            required>
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
                            placeholder="{{ __('auth.email') }}" value="{{ old('email', auth()->user()->email) }}"
                            required>
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
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('auth.new_password') }}">
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
                            placeholder="{{ __('auth.new_password_confirmation') }}" autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('admin.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
@if ($message = Session::get('success'))
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        toastr.success('{{ $message }}')
    </script>
@endif
@endsection