@extends('layouts.web_layout')

@section('content')
<main>
    <section class="py-4 bg-light slots_section">
        <div class="container">
            <div class="row">
                <!-- Left Navigation -->
                <div class="col-md-3">
                    @include('elements.left_navigation')
                </div>
                <!-- Slots Section -->
                <div class="col-md-9 bg-white shadow p-4">
                    <h4 class="mb-3 text-success">Lead a Session</h4>
                    <hr>
                    <form method="GET" action="{{ route('user.availableslots') }}" class="mb-4" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="from_date" class="form-label">From Date:</label>
                                <input type="text" class="form-control datepicker" name="from_date" id="from_date"
                                    value="{{ request('from_date') }}" placeholder="Select From Date" required>
                            </div>

                            <div class="col-md-4">
                                <label for="to_date" class="form-label">To Date:</label>
                                <input type="text" class="form-control datepicker" name="to_date" id="to_date"
                                    value="{{ request('to_date') }}" placeholder="Select To Date" required>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100"
                                    style="margin-top: 30px;">Filter</button>
                            </div>
                        </div>
                    </form>


                    <div class="row g-4">
                        @foreach ($slots as $slot)
                            <div class="col-md-4">
                                <div class="bg-white py-4 px-4 shadow">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title pb-3 fw-bold">{{ ucfirst($slot->name) }}</h5>
                                        <p class="card-text py-3" style="font-size: 14px;">
                                            <span class="text-dark h6"><i class="fa-solid fa-calendar-days me-2"></i>Date:
                                            </span>
                                            {{$slot->date}}
                                        </p>
                                        <p class="card-text" style="font-size: 14px;">
                                            <span class="text-dark h6"><i class="fa-solid fa-clock me-2"></i>Timing: </span>
                                            {{ $slot->start_time }} -
                                            {{ $slot->end_time }}
                                        </p>
                                        
                                        <div class="pt-3">
                                            @if (!empty($slot->sessionLeads) && $slot->sessionLeads->status == 0)
                                                <button class="btn btn-warning w-100 px-0 mx-0" disabled>Approval
                                                    Pending</button>
                                            @else
                                                <button class="btn btn-primary w-100 open-modal" data-slot-id="{{ $slot->id }}">
                                                    Reserve Slot
                                                </button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="bookSlotModal" tabindex="-1" aria-labelledby="bookSlotModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookSlotModalLabel">Reserve Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="bookSlotForm">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="slot_id" id="slot_id">
                    <div class="mb-3">
                        <label for="agenda" class="form-label">Short Description<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="agenda" id="agenda" required>
                        <small class="text-danger d-none" id="agenda_error">Short Description is required.</small>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description<sup class="text-danger">*</sup></label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                        <small class="text-danger d-none" id="dec_error">Description is required.</small>
                    </div>
                    <div class="mb-3">
                        <label for="other_details" class="form-label">Background knowledge expected <sup class="text-danger">*</sup></label>
                        <textarea class="form-control" name="other_details" id="other_details" rows="2"></textarea>
                        <small class="text-danger d-none" id="other_details_error">Background knowledge expected field is required.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Populate slot ID in the hidden field when "Book Now" is clicked
    document.querySelectorAll('.open-modal').forEach(button => {


        button.addEventListener('click', function () {
            const slotId = this.getAttribute('data-slot-id');
            // AJAX request to check slot status
            fetch('{{ route('check.slot.status') }}', {
                method: 'POST',
                body: JSON.stringify({
                    slot_id: slotId
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Open modal if slot is available
                        document.getElementById('slot_id').value = slotId;
                        const modal = new bootstrap.Modal(document.getElementById('bookSlotModal'));
                        modal.show();
                    } else {
                        // Show error if slot is already booked
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Something went wrong!',
                        icon: 'error',
                    });
                });
        });
    });


    // Handle form submission
    document.getElementById('bookSlotForm').addEventListener('submit', function (e) {
        e.preventDefault();
        // Validate Short Description
        if ($("#agenda").val() == "") {
            $("#agenda_error").removeClass("d-none").addClass("d-block");
            return false;
        } else {
            $("#agenda_error").removeClass("d-block").addClass("d-none");
        }

        // Validate Description
        if ($("#description").val() == "") {
            $("#dec_error").removeClass("d-none").addClass("d-block");
            return false;
        } else {
            $("#dec_error").removeClass("d-block").addClass("d-none");
        }

        if ($("#other_details").val() == "") {
            $("#other_details_error").removeClass("d-none").addClass("d-block");
            return false;
        } else {
            $("#other_details_error").removeClass("d-block").addClass("d-none");
        }


        


        // Serialize form data
        const formData = new FormData(this);

        fetch('{{ route('sessionleads.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Slot booked successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message || 'Something went wrong!',
                        icon: 'error',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Something went wrong!',
                    icon: 'error',
                });
            });
    });
</script>
@endsection