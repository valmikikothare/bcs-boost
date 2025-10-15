@extends('layouts.admin_main')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between bg-dark px-4 py-3">
                <div>
                    <h4 class="text-white m-0">Manage Slots</h4>
                </div>
                <div>
                    <a class="btn btn-success" href="{{ route('export.slots.csv') }}">Export CSV</a>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createSlotModal">Add Slot</button>
                </div>
            </div>

            <div class="bg-white shadow py-4 px-4">
                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>No. of Attendees</th>
                                    <th>No. of Attendees Registered</th>
                                    <th>Status</th> <!-- New column -->

                                    <th>Actions</th>
                                    {{-- <th>Leads</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slots as $slot)
                                    <tr id="slotRow_{{ $slot->id }}">
                                        <td>{{ $slot->name }}</td>
                                        <td>{{ $slot->date }}</td>
                                        <td>{{ $slot->start_time }}</td>
                                        <td>{{ $slot->end_time }}</td>
                                        <td>{{ $slot->no_of_attendees }}</td>
                                        <td>{{ $slot->bookinghistory_count }}</td>
                                        <td>

                                            @if ($slot->status == 0)
                                                <p class="badge badge-warning">Pending</p>
                                            @elseif($slot->status == 1)
                                                <p class="badge badge-success">Approved</p>
                                            @elseif($slot->status == 2)
                                                <p class="badge badge-success">Completed</p>
                                            @endif
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editSlotModal"
                                                onclick="editSlot({
                                                                        id: {{ $slot->id }},
                                                                        name: '{{ $slot->name }}',
                                                                        date: '{{ $slot->date }}',
                                                                        start_time: '{{ $slot->start_time }}',
                                                                        end_time: '{{ $slot->end_time }}',
                                                                        no_of_attendees: {{ $slot->no_of_attendees }}
                                                                    })">
                                                Edit
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $slot->id }})" data-toggle="tooltip"
                                                title="Delete">Delete</button>
                                            <a href="{{ route('slots.leads', $slot->id) }}"
                                                class="btn btn-info btn-sm">View
                                                Leads</a>
                                            <a href="{{ route('view_attendees', $slot->id) }}"
                                                class="btn btn-primary btn-sm">View
                                                Attendees</a>
                                            @if (!empty($slot->sessionLeads->id))
                                                <a href="{{ route('slots.markas_complete', $slot->sessionLeads->id) }}"
                                                    class="btn btn-info btn-sm ">Mark as Complete</a>
                                            @endif

                                        </td>
                                        {{-- <td>
                                        <a href="{{ route('slots.leads', $slot->id) }}" class="btn btn-info btn-sm">View
                                            Leads</a>

                                    </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Slot Modal -->
    <div class="modal fade" id="createSlotModal" tabindex="-1" role="dialog" aria-labelledby="createSlotModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="createSlotForm" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSlotModalLabel">Add Slot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" placeholder="Slot #1" class="form-control" id="name"
                                        name="name" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="text" name="date" id="date" placeholder="Select Date"
                                        class="form-control datepicker" value="{{ old('date') }}" required>
                                    @if ($errors->has('date'))
                                        <span class="text-danger">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Start Time Field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="text" name="start_time" id="start_time" class="form-control timepicker"
                                        value="{{ old('start_time') }}" required>
                                    @if ($errors->has('start_time'))
                                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- End Time Field -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="end_time">End Time</label>
                                    <input type="text" name="end_time" id="end_time" class="form-control timepicker"
                                        value="{{ old('end_time') }}" required>
                                    @if ($errors->has('end_time'))
                                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no_of_attendees">No. of Attendees</label>
                                    <input type="number" class="form-control" id="no_of_attendees" name="no_of_attendees"
                                        min="1" required>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Slot</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Slot Modal -->
    <div class="modal fade" id="editSlotModal" tabindex="-1" role="dialog" aria-labelledby="editSlotModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editSlotForm">
                @csrf
                @method('POST')
                <input type="hidden" id="edit_slot_id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSlotModalLabel">Edit Slot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="edit_name">Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="edit_date">Date</label>
                                    <input type="text" class="form-control datepicker" id="edit_date" name="date"
                                        required>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="edit_start_time">Start Time</label>
                                    <input type="text" class="form-control timepicker" id="edit_start_time"
                                        name="start_time" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="edit_end_time">End Time</label>
                                    <input type="text" class="form-control timepicker" id="edit_end_time"
                                        name="end_time" required>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="edit_no_of_attendees">No. of Attendees</label>
                                    <input type="number" class="form-control" id="edit_no_of_attendees"
                                        name="no_of_attendees" min="1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Update Slot</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // Submit Create Slot Form
        $('#createSlotForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('slots.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Slot added successfully!', 'success').then(() => {
                            location.reload(); // Reload to show updated data
                        });
                    }
                },
                error: function(xhr) {
                    $('#createSlotForm .text-danger').remove(); // Clear previous errors
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`#createSlotForm [name="${field}"]`)
                                .after(`<span class="text-danger">${errors[field][0]}</span>`);
                        }
                    } else {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                }
            });
        });


        function editSlot(slot) {
            $('#edit_slot_id').val(slot.id);
            $('#edit_name').val(slot.name);
            $('#edit_date').val(slot.date);
            $('#edit_start_time').val(slot.start_time);
            $('#edit_end_time').val(slot.end_time);
            $('#edit_no_of_attendees').val(slot.no_of_attendees);
        }

        // Handle Edit Slot Form Submission
        $('#editSlotForm').submit(function(e) {
            e.preventDefault();
            let id = $('#edit_slot_id').val();
            $.ajax({
                url: `/slots/${id}`,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success', 'Slot updated successfully!', 'success').then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    $('#editSlotForm .text-danger').remove();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`#editSlotForm [name="${field}"]`)
                                .after(`<span class="text-danger">${errors[field][0]}</span>`);
                        }
                    } else {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Your slot will be deleted permanently!',
                text: 'Are you sure to proceed?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Remove slot!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/slots/${id}`, // The URL for deleting the slot
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(resultData) {
                            console.log('resultData', resultData);

                            // Check if the deletion was successful
                            if (resultData.success) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Slot Deleted',
                                    text: 'The slot has been deleted successfully.',
                                });

                                // Remove the row with the corresponding ID from the table
                                $('#slotRow_' + id)
                                    .remove(); // Adjust the row ID based on your HTML structure
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle any error response here
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });
        }
    </script>
@endsection
