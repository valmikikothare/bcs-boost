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
                        <h4 class="mb-3 text-success">Book a Session</h4>
                        <hr>


                        <div class="mb-3 text-end">
                            <button id="toggleViewBtn" class="btn btn-outline-secondary">
                                Switch to Table View
                            </button>
                        </div>

                        {{-- CARD VIEW --}}
                        <div class="row g-4" id="cardView">
                            @if ($slots->count() > 0 || $confirmedBookings->count() > 0)
                                {{-- Show Confirmed Bookings --}}
                                @foreach ($confirmedBookings as $booking)
                                    @php
                                        $slot = $booking->slot;
                                        $lead = $slot ? $slot->sessionLeads->where('status', 1)->first() : null;
                                    @endphp

                                    <div class="col-md-6">
                                        <div class="bg-white py-4 px-4 shadow">
                                            <div class="card-body d-flex flex-column">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title pb-3 fw-bold">{{ ucfirst(optional($slot)->name) }}
                                                    </h5>

                                                    <div class="dropdown" style="cursor: pointer;">
                                                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li>
                                                                <a class="dropdown-item viewDetails" href="#"
                                                                    data-bs-toggle="modal" data-bs-target="#slotDetailModal"
                                                                    data-name="{{ optional($slot)->name }}"
                                                                    data-agenda="{{ $lead->agenda ?? ' ' }}"
                                                                    data-description="{{ $lead->description ?? ' ' }}"
                                                                    data-date="{{ $slot->date ?? ' ' }}"
                                                                    data-timing="{{ $slot->start_time ?? '' }} - {{ $slot->end_time ?? '' }}"
                                                                    data-status="1">
                                                                    View Details
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div>
                                                    <p>Short Description : {{ $lead->agenda ?? ' ' }}</p>
                                                </div>

                                                <p class="card-text py-3" style="font-size: 14px;">
                                                    <span class="text-dark h6"><i
                                                            class="fa-solid fa-calendar-days me-2"></i>Date:</span>
                                                    {{ $slot->date ?? '' }}
                                                </p>

                                                <p class="card-text" style="font-size: 14px;">
                                                    <span class="text-dark h6"><i
                                                            class="fa-solid fa-clock me-2"></i>Time:</span>
                                                    {{ $slot->start_time ?? '' }} - {{ $slot->end_time ?? '' }}
                                                </p>

                                                <div class="pt-3">
                                                    <button class="btn btn-secondary w-100 mx-0" disabled>Booked</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Show Available Slots --}}
                                @foreach ($slots as $slot)
                                    @php
                                        $lead = $slot->sessionLeads->where('status', 1)->first();
                                        $isLead = $leadSlots->contains('id', $slot->id);
                                    @endphp

                                    <div class="col-md-6">
                                        <div class="bg-white py-4 px-4 shadow">
                                            <div class="card-body d-flex flex-column">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title pb-3 fw-bold">{{ ucfirst($slot->name) }}</h5>
                                                </div>

                                                <div>
                                                    <p>Short Description : {{ $lead->agenda ?? ' ' }}</p>
                                                </div>

                                                <p class="card-text py-3" style="font-size: 14px;">
                                                    <span class="text-dark h6"><i
                                                            class="fa-solid fa-calendar-days me-2"></i>Date:</span>
                                                    {{ $slot->date }}
                                                </p>

                                                <p class="card-text" style="font-size: 14px;">
                                                    <span class="text-dark h6"><i
                                                            class="fa-solid fa-clock me-2"></i>Time:</span>
                                                    {{ $slot->start_time }} - {{ $slot->end_time }}
                                                </p>

                                                <div class="pt-3">
                                                    @if ($isLead)
                                                        <button class="btn btn-success w-100" disabled>Confirmed</button>
                                                    @else
                                                        <button class="btn btn-primary w-100 open-modal"
                                                            data-bs-toggle="modal" data-bs-target="#bookSlotModal"
                                                            data-slot-name="{{ $slot->name }}"
                                                            data-slot-id="{{ $slot->id }}">
                                                            Book a Seat
                                                        </button>
                                                    @endif
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


                        {{-- TABLE VIEW (Hidden by default) --}}
                        {{-- TABLE VIEW (Available + Confirmed) --}}
                        <div id="tableView" class="d-none">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Slot Name</th>
                                            <th>Leader</th>
                                            <th>Agenda</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Confirmed Bookings --}}
                                        @foreach ($confirmedBookings as $booking)
                                            @php
                                                $slot = $booking->slot;
                                                $lead = $slot ? $slot->sessionLeads->where('status', 1)->first() : null;
                                            @endphp
                                            <tr>
                                                <td>{{ $slot->name ?? 'N/A' }}</td>
                                                <td>{{ $lead && $lead->user ? $lead->user->name : 'N/A' }}</td>
                                                <td>{{ $lead->agenda ?? 'N/A' }}</td>
                                                <td>{{ $slot->date ?? 'N/A' }}</td>
                                                <td>{{ $slot->start_time ?? 'N/A' }} - {{ $slot->end_time ?? 'N/A' }}</td>
                                                <td><span class="badge bg-success">Confirmed</span></td>
                                                <td>
                                                    <button class="btn btn-secondary btn-sm" disabled>Booked</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- Available Slots --}}

                                        {{-- Available Slots --}}
                                        @foreach ($slots as $slot)
                                            @php
                                                $lead = $slot->sessionLeads->where('status', 1)->first();
                                                $isLead = $leadSlots->contains('id', $slot->id);
                                            @endphp
                                            <tr>
                                                <td>{{ $slot->name ?? 'N/A' }}</td>
                                                <td>{{ $lead && $lead->user ? $lead->user->name : 'N/A' }}</td>
                                                <td>{{ $lead->agenda ?? 'N/A' }}</td>
                                                <td>{{ $slot->date ?? 'N/A' }}</td>
                                                <td>{{ $slot->start_time ?? 'N/A' }} - {{ $slot->end_time ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($isLead)
                                                        <span class="badge bg-success">Confirmed</span>
                                                    @else
                                                        <span class="badge bg-primary text-white">Available</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($isLead)
                                                        <button class="btn btn-success btn-sm" disabled>Confirmed</button>
                                                    @else
                                                        <button class="btn btn-primary btn-sm open-modal"
                                                            data-bs-toggle="modal" data-bs-target="#bookSlotModal"
                                                            data-slot-name="{{ $slot->name }}"
                                                            data-slot-id="{{ $slot->id }}">
                                                            Book a Seat
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if ($confirmedBookings->isEmpty() && $slots->isEmpty())
                                    <div class="text-center">
                                        <p>No Records Found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>


                        {{-- Toggle Script --}}

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="bookSlotModal" tabindex="-1" aria-labelledby="bookSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookSlotModalLabel">Slot a Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to book this slot?</p>
                    <input type="hidden" name="slot_id" id="slot_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmBooking">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="slotDetailModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Slot Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Slot Name</th>
                                <td id="modalSlotName"></td>
                            </tr>
                            <tr>
                                <th>Short Description</th>
                                <td id="modalAgenda"></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td id="modalDate"></td>
                            </tr>
                            <tr>
                                <th>Timing</th>
                                <td id="modalTiming"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="modalStatus"></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td id="modalDescription"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="loader"
        style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('toggleViewBtn').addEventListener('click', function() {
            const cardView = document.getElementById('cardView');
            const tableView = document.getElementById('tableView');
            const btn = this;

            if (cardView.classList.contains('d-none')) {
                cardView.classList.remove('d-none');
                tableView.classList.add('d-none');
                btn.textContent = 'Switch to Table View';
            } else {
                cardView.classList.add('d-none');
                tableView.classList.remove('d-none');
                btn.textContent = 'Switch to Card View';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('bookSlotModal');
            const modalTitle = modal.querySelector('.modal-title');
            const confirmButton = modal.querySelector('#confirmBooking');
            const slotIdInput = modal.querySelector('#slot_id');

            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', () => {
                    const slotId = button.getAttribute('data-slot-id');
                    const slotName = button.getAttribute('data-slot-name');

                    slotIdInput.value = slotId;
                    modalTitle.textContent =
                        `Book Your Seat for ${slotName.length > 20 ? slotName.substr(0, 20) + "..." : slotName}`;

                });
            });

            // Handle confirmation click (Yes button)
            confirmButton.addEventListener('click', () => {
                const slotId = slotIdInput.value;

                // Show loader
                document.getElementById('loader').style.display = 'flex';

                fetch('{{ route('bookasession') }}', {
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
                        // Hide loader
                        document.getElementById('loader').style.display = 'none';

                        if (data.success) {
                            Swal.fire({
                                title: 'Success',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => location.reload());
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
                        // Hide loader
                        document.getElementById('loader').style.display = 'none';

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



        document.addEventListener('DOMContentLoaded', function() {
            const modalTitle = document.getElementById('modalTitle');
            const modalSlotName = document.getElementById('modalSlotName');
            const modalAgenda = document.getElementById('modalAgenda');
            const modalDescription = document.getElementById('modalDescription');
            const modalDate = document.getElementById('modalDate');
            const modalTiming = document.getElementById('modalTiming');
            const modalStatus = document.getElementById('modalStatus');

            document.querySelectorAll('.viewDetails').forEach(button => {
                button.addEventListener('click', function() {
                    modalTitle.textContent = `Slot Details - ${this.dataset.name}`;
                    modalSlotName.textContent = this.dataset.name;
                    modalAgenda.textContent = this.dataset.agenda;
                    modalDescription.textContent = this.dataset.description;
                    modalDate.textContent = this.dataset.date;
                    modalTiming.textContent = this.dataset.timing;

                    let statusText = 'Pending Approval';
                    if (this.dataset.status == 1) {
                        statusText = 'Approved';
                    } else if (this.dataset.status == 2) {
                        statusText = 'Rejected';
                    }
                    modalStatus.textContent = statusText;
                });
            });
        });
    </script>
@endsection
