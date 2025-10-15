@extends('layouts.web_layout')

@section('content')

<section class="py-lg-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('elements.left_navigation')
            </div> 
            <div class="col-md-9">
              <div class="bg-white p-3 rounded shadow-sm">
                <h4 class="mb-3 text-success">{{ __('frontend.change_pass') }}</h4>
                <hr>
                <div>
                <p class="help_text margin-bott-20">{{ __('frontend.change_password_helptext') }}</p>
                <form action="{{ route('updatepassword', $user->id) }}" method="POST">
                @csrf
                
                <div class="row g-3">
                      <div class="col-md-12">
                        <label class="form-label">{{ __('frontend.current_password') }}</label>
                        <input type="password" name="current_password" class="form-control" required>
                        @error('current_password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">{{ __('frontend.new_password') }}</label>
                        <input type="password" name="new_password" class="form-control" required>
                        @error('new_password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">{{ __('frontend.confirm_password') }}</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                        @error('confirm_password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <input type="submit" value="{{ __('frontend.submit') }}" class="btn btn-success">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>






@endsection