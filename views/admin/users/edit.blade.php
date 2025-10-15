@extends('layouts.admin_main')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between bg-dark px-4 py-3">
                <div>
                    <h4 class="text-white m-0">Update User</h4>
                </div>
                <div>
                    <a class="btn btn-outline-primary" href="{{ route('users.index') }}">{{ __('admin.back') }}</a>
                </div>
            </div>
            <div class="bg-white shadow py-3 px-2">
                <div class="card-body p-3">
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('get')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('admin.user_name') }}</strong>
                                    <input type="text" name="name" value="{{ $users->name }}" class="form-control"
                                        placeholder="{{ __('fadmin.users_name') }}">

                                    @error('name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('admin.user_email') }}</strong>
                                    <input type="email" name="email" value="{{ $users->email }}" class="form-control"
                                        placeholder="{{ __('admin.users_email') }}">
                                    @error('email')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('admin.new_pass') }}</strong>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ __('admin.new_pas') }}">
                                    @error('password')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('admin.confirm_new_pass') }}</strong>
                                    <input type="password" name="confirm_password" class="form-control"
                                        placeholder="{{ __('admin.confirm_new_pass') }}">
                                    @error('confirm_password')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- New laboratory_name field -->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Laboratory Name</strong>
                                    <input type="text" name="laboratory_name" value="{{ $users->laboratory_name }}"
                                        class="form-control" placeholder="Enter laboratory name">
                                    @error('laboratory_name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- End laboratory_name -->


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('admin.images') }}</strong>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if ($users->image)
                                    <div class="form-group">
                                        <strong>{{ __('admin.current_image') }}</strong>
                                        <br>
                                        <img src="{{ asset('/admin/assets/images/' . $users->image) }}" alt="Current Image"
                                            class="img-fluid" width="200">
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary ml-3">{{ __('admin.submit') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
