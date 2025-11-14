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
                        <div class="">
                            <h4 class="mb-3 text-success">{{ __('frontend.profile') }}</h4>
                        </div>

                        <div>
                            <p class="help_text margin-bott-20">{{ __('frontend.profile_helptext') }}</p>
                            <form method="POST" action="{{ route('updateprofile', ['id' => auth()->user()->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('GET')
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('frontend.name') }}</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ auth()->user()->name }}" maxlength="50" />
                                    </div>



                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('frontend.email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', auth()->user()->email) }}" />

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <label class="form-label">Laboratory or office in Building 46 are you associated
                                            with?</label>
                                        <input type="text" class="form-control" name="laboratory_name"
                                            value="{{ auth()->user()->laboratory_name }}" />
                                    </div>


                                    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('admin.images') }}</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        @if (auth()->user()->image)
                                            <div class="form-group">
                                                <label class="form-label pt-3">{{ __('admin.current_image') }}</label>
                                                <br>
                                                <img src="{{ asset('/admin/assets/images/' . auth()->user()->image) }}"
                                                    alt="Current Image" class="img-fluid" width="200">
                                            </div>
                                        @endif
                                    </div> --}}

                                    <div class="col-md-6">
                                        <input type="submit" value="{{ __('frontend.submit') }}"
                                            class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-lg-9">
                    <div class="py-4 px-3 bg-light">
                        {{-- <form id="delete-account-form" method="POST" action="{{ route('unregister', ['id' => auth()->user()->id]) }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm mx-0" onclick="confirmAccountDeletion()">
              <i class="fa fa-trash"></i> Delete Account
            </button>
          </form> --}}
                        <p class="text-muted" style="font-size: 14px;">
                            if you wish to delete your account, please send an email to the administrator at
                            <a href="mailto:bcs-boost@mit.edu">bcs-boost@mit.edu</a>.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmAccountDeletion() {

            fetch(`/check-active-slot`)
                .then(response => response.json())
                .then(data => {
                    if (data.has_active_slot) {
                        // Show an alert if there's an active slot
                        Swal.fire({
                            title: 'You have an active slot!',
                            text: 'You cannot delete your account until your slot is completed.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    } else {
                        Swal.fire({
                            title: 'Your account will be deleted permanently!',
                            text: 'All your data will be lost. Are you sure you want to proceed?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, delete my account!',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Submit the delete account form
                                document.getElementById('delete-account-form').submit();
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error checking active slot:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong while checking your active slot.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                });
        }
    </script>
@endsection
