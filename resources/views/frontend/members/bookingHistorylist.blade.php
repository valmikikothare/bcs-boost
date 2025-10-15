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
                    <h4 class="mb-3 text-success">Booking History</h4>
                    <hr>
                    <div class="row g-4">
                        @if($slots->count() > 0)
                            @foreach ($slots as $slot)
                                <div class="col-md-6">
                                    <div class="bg-white py-4 px-4 shadow">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title pb-3 fw-bold">{{ ucfirst($slot->slot->name) }}</h5>

                                                <div class="dropdown" style="cursor: pointer;">
                                                    <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown" aria-expanded="false"></i>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a class="dropdown-item" href="{{route('user.cancelBookingById',['id'=>$slot->id,'slot_id'=>$slot->slot->id])}}">Cancel Booking</a></li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <p class="card-text py-3" style="font-size: 14px;">
                                                <span class="text-dark h6"><i
                                                        class="fa-solid fa-calendar-days me-2"></i>Date:</span>
                                                {{ $slot->slot->date }}
                                            </p>

                                            <p class="card-text" style="font-size: 14px;">
                                                <span class="text-dark h6"><i class="fa-solid fa-clock me-2"></i>Timing:</span>
                                                {{ $slot->slot->start_time }} - {{ $slot->slot->end_time }}
                                            </p>

                                            <div class="pt-3">
                                                <button class="btn btn-success w-100 px-0 mx-0" disabled>Booked
                                                    Successfully</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                <p>No Records Found.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="bookSlotModal" tabindex="-1" aria-labelledby="bookSlotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookSlotModalLabel">Slot a Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h5>Are you sure you want to book this slot?</h5>
                <input type="hidden" name="slot_id" id="slot_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmBooking">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('bookSlotModal');
        const modalTitle = modal.querySelector('.modal-title');
        const confirmButton = modal.querySelector('#confirmBooking');
        const slotIdInput = modal.querySelector('#slot_id');

        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', () => {
                const slotId = button.getAttribute('data-slot-id');
                slotIdInput.value = slotId; // Set the slot ID in the hidden input
                modalTitle.textContent = `Book Slot #${slotId}`; // Dynamically change the title
            });
        });

        // Handle confirmation click (Yes button)
        confirmButton.addEventListener('click', () => {
            const slotId = slotIdInput.value;

            // Make an API call to book the session
            fetch('{{ route('bookasession') }}', {
                method: 'POST',
                body: JSON.stringify({slot_id: slotId}),
                headers: {
                    'Content-Type': 'application/json',
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
                            location.reload(); // Reload page after booking
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

            // Close the modal
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    });
</script>
@endsection