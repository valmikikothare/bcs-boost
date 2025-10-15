@extends('layouts.admin_main')
@section('content')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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


    <!-- Reset System & Export Section -->
    <div class="content mb-4">
        <div class="container-fluid">
            <!-- Card Section -->
            <div class="bg-white shadow mt-4 overflow-hidden">

                <!-- Header Section with Dark Background -->
                <div class="bg-dark px-4 py-3">
                    <h4 class="text-white m-0">Reset System & Export</h4>
                </div>
                <p class="text-secondary  mx-3 my-2" style="font-size:22px;">
                    Warning: Resetting the system will permanently delete all user data, slot records, newsletter
                    subscriptions and Other. This action cannot be undone.
                </p>
                <!-- Card Body -->
                <div class="px-4 py-4">
                    <!-- Export Users -->
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <h5 class="mb-0">Export Users</h5>
                        <a href="{{ route('users.export.csv') }}" class="btn btn-success">Export Users CSV</a>
                    </div>

                    <!-- Export Slots -->
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <h5 class="mb-0">Export Slots With Attendees</h5>
                        <a href="{{ route('resetslots.export.csv') }}" class="btn btn-success">Export Slots CSV</a>
                    </div>

                    <!-- Export Newsletter Subscribers -->
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <h5 class="mb-0">Export Newsletter Subscribers</h5>
                        <a href="{{ route('newsletter.export.csv') }}" class="btn btn-success">Export Newsletter CSV</a>
                    </div>

                    <!-- Reset System -->
                    <div class="d-flex justify-content-start mt-4">
                        <!-- Trigger Button -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetModal">
                            Reset System
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('system.reset') }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="resetModalLabel">Confirm System Reset</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you absolutely sure you want to reset the system? This action is
                                                irreversible.</p>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="export_users"
                                                    id="exportUsers">
                                                <label class="form-check-label" for="exportUsers">
                                                    I have confirmed the export of the user list.
                                                </label>
                                            </div>

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="export_slots"
                                                    id="exportSlots">
                                                <label class="form-check-label" for="exportSlots">
                                                    I have confirmed the export of slot data.
                                                </label>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="export_newsletter"
                                                    id="exportNewsletter">
                                                <label class="form-check-label" for="exportNewsletter">
                                                    I have confirmed the export of newsletter subscription data.
                                                </label>
                                            </div>

                                            <p>To confirm, please type <strong>delete</strong> below:</p>
                                            <input type="text" id="confirmResetInput" name="confirm"
                                                class="form-control" placeholder="Type 'delete' to enable" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" id="confirmResetBtn" class="btn btn-danger"
                                                disabled>Yes, Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#confirmResetInput').on('input', function() {
                const inputVal = $(this).val().trim();
                const isConfirmed = inputVal === 'delete';
                $('#confirmResetBtn').prop('disabled', !isConfirmed);
            });
        });
    </script>

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
