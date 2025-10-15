@extends('layouts.admin_main')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between bg-dark px-4 py-3">
                <div>
                    <h4 class="text-white m-0">Manage Users</h4>
                </div>
                <div>
                    <a class="btn btn-success me-2" href="{{ route('users.export.csv') }}">
                        Export CSV
                    </a>
                    <a class="btn btn-primary" href="{{ route('users.create') }}">
                        {{ __('admin.add_user') }}
                    </a>
                </div>
            </div>

            <div class="bg-white shadow py-4 px-4">
                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.name') }}</th>
                                    <th>{{ __('admin.email') }}</th>
                                    <th>Laboratory or office </th>
                                    <th>{{ __('admin.image') }} </th>
                                    <th>{{ __('admin.action') }}</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="userRow_{{ $user->id }}">

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->laboratory_name }}</td>
                                        <td>
                                            @if ($user->image)
                                                <img src="{{ asset('/admin/assets/images/' . $user->image) }}"
                                                    width="50">
                                            @else
                                                No Image Available
                                            @endif
                                        </td>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                                        <script>
                                            $(function() {
                                                $('[data-toggle="tooltip"]').tooltip()
                                            })
                                        </script>
                                        <td>

                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                                data-toggle="tooltip" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <!-- @csrf
                                                                                                                                            @method('DELETE') -->
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $user->id }})" data-toggle="tooltip"
                                                title="Delete"><i class="fa-solid fa-trash"></i></button>
                                            @if ($user->verified_status != 1)
                                                <button type="button" class="btn btn-success btn-sm"
                                                    onclick="verifyUser({{ $user->id }})" data-toggle="tooltip"
                                                    title="Verify User"><i class="fa-solid fa-check"></i></button>
                                            @else
                                                <button type="button" class="btn btn-secondary btn-sm" disabled
                                                    title="Already Verified"><i
                                                        class="fa-solid fa-check-double"></i></button>
                                            @endif

                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                            <script>
                                                function confirmDelete(id) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "{{ route('users.checkBeforeDelete') }}",
                                                        data: {
                                                            id: id,
                                                            "_token": "{{ csrf_token() }}"
                                                        },
                                                        success: function(response) {
                                                            if (!response.success) {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Error',
                                                                    text: response.message
                                                                });
                                                                return;
                                                            }

                                                            Swal.fire({
                                                                title: 'Confirm Deletion',
                                                                text: response.message,
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#DD6B55',
                                                                confirmButtonText: 'Yes, delete',
                                                                cancelButtonText: 'Cancel',
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "{{ route('users.destroy') }}",
                                                                        data: {
                                                                            id: id,
                                                                            "_token": "{{ csrf_token() }}"
                                                                        },
                                                                        success: function(resultData) {
                                                                            if (resultData.success) {
                                                                                Swal.fire({
                                                                                    icon: 'success',
                                                                                    title: 'Deleted',
                                                                                    text: 'User and related data deleted successfully'
                                                                                });
                                                                                $('#userRow_' + id).remove();
                                                                            } else {
                                                                                Swal.fire({
                                                                                    icon: 'error',
                                                                                    title: 'Error',
                                                                                    text: resultData.message
                                                                                });
                                                                            }
                                                                        }
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            </script>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function verifyUser(id) {
            Swal.fire({
                title: 'Verify User',
                text: "Are you sure you want to verify this user?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes, verify',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('users.verify') }}",
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Verified',
                                    text: 'User has been successfully verified'
                                });

                                // Replace the verify button with disabled one
                                let row = $('#userRow_' + id);
                                row.find("button[onclick='verifyUser(" + id + ")']")
                                    .replaceWith(
                                        '<button class="btn btn-secondary btn-sm" disabled title="Already Verified"><i class="fa-solid fa-check-double"></i></button>'
                                        );
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
