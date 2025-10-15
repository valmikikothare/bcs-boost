@extends('layouts.admin_main')
@section('content')

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between bg-dark px-4 py-3">
            <div>
                <h4 class="text-white m-0">Add User</h4>
            </div>
            <div>
                <a class="btn btn-outline-primary" 
                    href="{{ route('users.index') }}">{{ __('admin.back') }}</a>
            </div>
        </div>
        <div class="bg-white shadow py-3 px-4">
            <div class="card-body p-0">
                @if(session('success'))
                    <div class="alert alert-success mb-1 mt-1">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('admin.user_name') }}</strong>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('admin.users_name') }}" maxlength="50">
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('admin.user_email') }}</strong>
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ __('admin.users_email') }}">
                                @error('email')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('admin.password') }}</strong>
                                <input type="password" name="password" class="form-control"
                                    placeholder="{{ __('admin.pass') }}">
                                @error('password')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('admin.confirm_pass') }}</strong>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="{{ __('admin.confirmed_pass') }}">
                                @error('password_confirmation')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('admin.images') }}</strong>
                                <input type="file" name="image" class="form-control-file">
                                @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary ml-3">{{ __('admin.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection