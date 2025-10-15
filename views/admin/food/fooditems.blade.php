@extends('layouts.admin_main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="alert alert-info">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="m-0">{{ __('admin.food_item') }}</span>
                        </div>

                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('admin.add') }} 
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-dark" href="{{ route('views.addfooditems') }}">{{ __('admin.add_food') }}</a>
                                <a class="dropdown-item text-dark" href="{{ route('views.uploadcsv') }}">{{ __('admin.add_csv') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                      
                                       
                                        <th>{{ __('admin.#') }}</th>
                                        <th>{{ __('admin.name') }}</th>
                                        <th>{{ __('admin.ingredient') }}</th>
                                        <th>{{ __('admin.portion') }}</th>
                                        <th>{{ __('admin.images') }}</th>

                                        <th>{{ __('admin.action') }}</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fooditems as $key => $foodItem)
                                    <tr id="foodItemRow_{{ $foodItem->id }}">
                                        <td>{{ ($fooditems->currentPage() - 1) * $fooditems->perPage() + $loop->iteration }}</td>
                                        <td>{{$foodItem->name}}</td>
                                        <td style="width: 20%">
                                                <div >
                                                    @foreach(explode(',',$foodItem->ingredients) as $key => $ingredients)
                                                <ul class="p-0 m-0">
                                                    @if($key <= 3)
                                                    <li>{{$ingredients}}</li>
                                                    @endif
                                                </ul>
                                            @endforeach
                                                </div>
                                        </td>
                                        <td>{{$foodItem->portions}}</td>
                                        <td>
                                            @if($foodItem->image)
                                            <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_NAME').$foodItem->image }}" alt="Food Item Image" width="100">
                                            @else
                                            No Image Available
                                            @endif
                                        </td>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                                     <script>
                                            $(function () {
                                            $('[data-toggle="tooltip"]').tooltip()
                                            })
                                     </script>
                                        <td>
                                            <a href="{{ route('views.showfooditem', $foodItem->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="View"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('views.editfooditem', $foodItem->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>

                                            <!-- Delete Button with Confirmation -->
                                            <!-- <form id="delete-form" action="{{ route('views.deletefooditem', $foodItem->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE') -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{$foodItem->id}})" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                            <!-- </form> -->

                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                            <script>
                                                function confirmDelete(id) {
                                                    Swal.fire({
                                                        title: 'Your food item will be deleted permanently!',
                                                        text: 'Are you sure to proceed?',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#DD6B55',
                                                        confirmButtonText: 'Remove Food Item!',
                                                        cancelButtonText: 'Cancel',
                                                        reverseButtons: true
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "{{ route('views.deletefooditem') }}",
                                                                data: {
                                                                    id: id,
                                                                    "_token": "{{ csrf_token() }}",
                                                                },
                                                                success: function(resultData) {
                                                                    console.log('resultData', resultData);

                                                                    // Check if the deletion was successful
                                                                    if (resultData.success) {

                                                                        Swal.fire({
                                                                            icon: 'success',
                                                                            title: 'Food Deleted',
                                                                            text: 'The Food Item has been deleted successfully.',
                                                                        });
                                                                        // Remove the deleted food item row from the table
                                                                        $('#foodItemRow_' + id).remove();
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
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <!-- Pagination -->
                        {{ $fooditems->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection