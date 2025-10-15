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
                <a class="btn btn-primary" href="{{ route('users.create') }}">{{ __('admin.add_user') }}</a>
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
                            @foreach($users as $user)
                                <tr id="userRow_{{ $user->id }}">
                                    
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->laboratory_name }}</td>
                                    <td>
                                        @if ($user->image)
                                        <img src="{{ asset('/admin/assets/images/'.$user->image) }}" width="50">
                                        @else
                                        No Image Available
                                        @endif
                                    </td>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                                    <script
                                        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                                    <script>
                                        $(function () {
                                            $('[data-toggle="tooltip"]').tooltip()
                                        })
                                    </script>
                                    <td>

                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                            data-toggle="tooltip" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <!-- @csrf
                                                                                            @method('DELETE') -->
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{$user->id}})" data-toggle="tooltip" title="Delete"><i
                                                class="fa-solid fa-trash"></i></button>


                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                        <script>
                                            function confirmDelete(id) {
                                                Swal.fire({
                                                    title: 'Your user will be deleted permanently!',
                                                    text: 'Are you sure to proceed?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#DD6B55',
                                                    confirmButtonText: 'Remove user!',
                                                    cancelButtonText: 'Cancel',
                                                    reverseButtons: true
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "{{ route('users.destroy') }}",
                                                            data: {
                                                                id: id,
                                                                "_token": "{{ csrf_token() }}",
                                                            },
                                                            success: function (resultData) {
                                                                console.log('resultData', resultData);

                                                                // Check if the deletion was successful
                                                                if (resultData.success) {

                                                                    Swal.fire({
                                                                        icon: 'success',
                                                                        title: 'User Deleted',
                                                                        text: 'The user has been deleted successfully.',
                                                                    });
                                                                    // Remove the deleted food item row from the table
                                                                    $('#userRow_' + id).remove();
                                                                }
                                                            }
                                                        });


                                                        // Proceed with form submission
                                                        document.getElementById('delete-form').submit();
                                                    } else {
                                                        // Cancel the form submission
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
@endsection

