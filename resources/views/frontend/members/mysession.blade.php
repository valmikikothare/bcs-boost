@extends('layouts.web_layout')

@section('content')
    <main>
        <section class="py-4 bg-light slots_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        @include('elements.left_navigation')
                    </div>

                    <div class="col-md-9 bg-white shadow p-4">
                        <h4 class="mb-3 text-success">My Sessions</h4>
                        <hr>


                        {{-- Tabs --}}
                        <ul class="nav nav-pills custom-tabs" id="sessionTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="leader-tab" data-bs-toggle="tab"
                                    data-bs-target="#leader" type="button" role="tab">
                                    <i class="fa-solid fa-chalkboard-teacher me-2"></i> Session I Lead
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="participant-tab" data-bs-toggle="tab"
                                    data-bs-target="#participant" type="button" role="tab">
                                    <i class="fa-solid fa-users me-2"></i> Sessions I Participate
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="sessionTabsContent">

                            {{-- Leader Tab --}}
                            <div class="tab-pane fade show active" id="leader" role="tabpanel">
                                @if ($leadSlots->isEmpty())
                                    <div class="alert alert-warning">No sessions found.</div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Slot Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($leadSlots as $slot)
                                                    @foreach ($slot->user_requests as $request)
                                                        <tr>
                                                            <td>{{ $slot->name }}</td>
                                                            <td>{{ $slot->date }}</td>
                                                            <td>{{ $slot->start_time }} - {{ $slot->end_time }}</td>
                                                            <td>
                                                                @if ($request['status'] == 0)
                                                                    <span class="badge bg-warning">Pending</span>
                                                                @elseif ($request['status'] == 1)
                                                                    <span class="badge bg-success">Confirmed</span>
                                                                @elseif ($request['status'] == 2)
                                                                    <span class="badge bg-danger">Rejected</span>
                                                                @elseif ($request['status'] == 3)
                                                                    <span class="badge bg-danger">Cancelled</span>
                                                                @elseif ($request['status'] == 4)
                                                                    <span class="badge bg-warning">Cancellation
                                                                        Pending</span>
                                                                @elseif ($request['status'] == 5)
                                                                    <span class="badge bg-danger">Cancelled</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="dropdown position-static">
                                                                    <button
                                                                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                        type="button"
                                                                        id="actionMenu{{ $slot->id }}-{{ $loop->index }}"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Actions
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="actionMenu{{ $slot->id }}-{{ $loop->index }}">
                                                                        @if ($request['status'] == 1)
                                                                            <li>
                                                                                @if ($request['status'] == 3 || $slot->hasPendingCancellation)
                                                                                    <a class="dropdown-item text-muted disabled"
                                                                                        href="javascript:void(0)">
                                                                                        <i
                                                                                            class="fa-solid fa-trash me-2"></i>
                                                                                        Cancel Session Lead
                                                                                    </a>
                                                                                @else
                                                                                    <a class="dropdown-item text-danger"
                                                                                        href="#"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#cancelSessionModal{{ $slot->id }}-{{ $loop->index }}">
                                                                                        <i
                                                                                            class="fa-solid fa-trash me-2"></i>
                                                                                        Cancel Session Lead
                                                                                    </a>
                                                                                @endif
                                                                            </li>
                                                                            {{-- <li>
                                                                                <a class="dropdown-item" href="#"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#viewSessionModal{{ $slot->id }}-{{ $loop->index }}">
                                                                                    <i class="fa-solid fa-eye me-2"></i>
                                                                                    View Details
                                                                                </a>
                                                                            </li> --}}
                                                                        @else
                                                                            <li>
                                                                                <a class="dropdown-item text-muted disabled"
                                                                                    href="javascript:void(0)">
                                                                                    <i class="fa-solid fa-ban me-2"></i>
                                                                                    Not Eligible
                                                                                </a>
                                                                            </li>
                                                                            {{-- <li>
                                                                                <a class="dropdown-item" href="#"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#viewSessionModal{{ $slot->id }}-{{ $loop->index }}">
                                                                                    <i class="fa-solid fa-eye me-2"></i>
                                                                                    View Details
                                                                                </a>
                                                                            </li> --}}
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <!-- Cancel Confirmation Modal -->
                                                        <div class="modal fade"
                                                            id="cancelSessionModal{{ $slot->id }}-{{ $loop->index }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger text-white">
                                                                        <h5 class="modal-title">Confirm Cancellation</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure you want to cancel the session
                                                                            <strong>{{ $slot->name }}</strong>
                                                                            scheduled on
                                                                            <strong>{{ $slot->date }}</strong>?
                                                                        </p>
                                                                        <p class="text-muted">
                                                                            <i class="fa-solid fa-info-circle me-2"></i>
                                                                            A cancellation request will be sent to the
                                                                            admin.
                                                                            The session will be cancelled after the admin
                                                                            confirms your request.
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <form
                                                                            action="{{ route('cancel.session', $slot->id) }}"
                                                                            method="POST" class="cancel-booking-form">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Yes, Cancel</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- View Session Modal -->
                                                        {{-- <div class="modal fade"
                                                            id="viewSessionModal{{ $slot->id }}-{{ $loop->index }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title">Session Lead Details</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @php
                                                                            $lead = $slot->sessionLeads
                                                                                ->where('status', 1)
                                                                                ->first();
                                                                        @endphp
                                                                        <p><strong>Lead Name:</strong>
                                                                            {{ $lead->user->name ?? 'N/A' }}
                                                                        </p>
                                                                        <p><strong>Agenda:</strong>
                                                                            {{ $lead->agenda ?? 'N/A' }}</p>
                                                                        <p><strong>Description:</strong>
                                                                            {{ $lead->description ?? 'N/A' }}</p>
                                                                        <p><strong>Other Details:</strong>
                                                                            {{ $lead->other_details ?? 'N/A' }}</p>
                                                                        <hr>
                                                                        <p><strong>Date:</strong> {{ $slot->date }}</p>
                                                                        <p><strong>Time:</strong> {{ $slot->start_time }} -
                                                                            {{ $slot->end_time }}</p>
                                                                        <p><strong>Status:</strong>
                                                                            @if ($request['status'] == 0)
                                                                                <span
                                                                                    class="badge bg-warning">Pending</span>
                                                                            @elseif ($request['status'] == 1)
                                                                                <span
                                                                                    class="badge bg-success">Confirmed</span>
                                                                            @elseif ($request['status'] == 2)
                                                                                <span
                                                                                    class="badge bg-danger">Rejected</span>
                                                                            @elseif ($request['status'] == 3)
                                                                                <span
                                                                                    class="badge bg-danger">Cancelled</span>
                                                                            @elseif ($request['status'] == 4)
                                                                                <span class="badge bg-warning">Cancellation
                                                                                    Pending</span>
                                                                            @elseif ($request['status'] == 5)
                                                                                <span
                                                                                    class="badge bg-danger">Cancelled</span>
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    @endforeach
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                @endif
                            </div>

                            {{-- Participant Tab --}}
                            {{-- Participant Tab --}}
                            <div class="tab-pane fade" id="participant" role="tabpanel">
                                @if ($participantSlots->isEmpty())
                                    <div class="alert alert-warning">No sessions found.</div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Slot Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($participantSlots as $slot)
                                                    <tr>
                                                        <td>{{ $slot->name }}</td>
                                                        <td>{{ $slot->date }}</td>
                                                        <td>{{ $slot->start_time }} - {{ $slot->end_time }}</td>
                                                        <td>
                                                            @if (!empty($slot->booking_history) && $slot->booking_history->status == 2)
                                                                <span class="badge bg-warning text-dark">waitlisted</span>
                                                            @else
                                                                <span class="badge bg-success">Confirmed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="dropdown position-static">
                                                                <button
                                                                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                    type="button"
                                                                    id="actionMenuParticipant{{ $slot->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Actions
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end"
                                                                    aria-labelledby="actionMenuParticipant{{ $slot->id }}">
                                                                    <li>
                                                                        <a class="dropdown-item text-danger"
                                                                            href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#cancelBookingModal{{ $slot->id }}">
                                                                            Cancel Booking
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#viewParticipantModal{{ $slot->id }}">
                                                                            <i class="fa-solid fa-eye me-2"></i>
                                                                            View Details
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Cancel Booking Confirmation Modal -->
                                                    <div class="modal fade" id="cancelBookingModal{{ $slot->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title">Confirm Cancellation</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to cancel your booking for
                                                                        <strong>{{ $slot->name }}</strong> scheduled on
                                                                        <strong>{{ $slot->date }}</strong>?
                                                                    </p>
                                                                    <p class="text-muted">
                                                                        <i class="fa-solid fa-info-circle me-2"></i>
                                                                        The booking will be cancelled after confirmation.
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>

                                                                    <form
                                                                        action="{{ route('user.cancelBookingById', ['id' => $slot->booking_id, 'slot_id' => $slot->id]) }}"
                                                                        method="POST" class="cancel-booking-form">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-cancel-booking">Yes,
                                                                            Cancel</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- View Participant Details Modal -->
                                                    <div class="modal fade" id="viewParticipantModal{{ $slot->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h5 class="modal-title">Session Participant Details
                                                                    </h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $lead = $slot->sessionLeads->where('status', 1)->first();
                                                                    @endphp
                                                                    <p><strong>Lead Name:</strong>
                                                                        {{ $lead->user->name ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Short Description:</strong>
                                                                        {{ $lead->agenda ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Description:</strong>
                                                                        {{ $lead->description ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Background knowledge expected:</strong>
                                                                        {{ $lead->other_details ?? 'N/A' }}
                                                                    </p>
                                                                    <hr>
                                                                    <p><strong>Date:</strong> {{ $slot->date }}</p>
                                                                    <p><strong>Time:</strong> {{ $slot->start_time }} -
                                                                        {{ $slot->end_time }}</p>
                                                                    <p><strong>Status:</strong>
                                                                        @if (!empty($slot->booking_history) && $slot->booking_history->status == 2)
                                                                            <span
                                                                                class="badge bg-warning text-dark">Waitlisted</span>
                                                                        @else
                                                                            <span class="badge bg-success">Confirmed</span>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div id="loader"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all cancel booking forms
            const cancelForms = document.querySelectorAll('.cancel-booking-form');
            cancelForms.forEach(form => {
                form.addEventListener('submit', function() {
                    // Show loader
                    document.getElementById('loader').style.display = 'flex';
                });
            });
        });
    </script>

@endsection

@push('styles')
    <style>
        /* Pill-style tabs */
        .custom-tabs .nav-link {
            border-radius: 10px 10px 0 0;
            background: #f1f3f5;
            color: #495057;
            font-weight: 600;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .custom-tabs .nav-link i {
            font-size: 14px;
        }

        .custom-tabs .nav-link.active {
            background: #0d6efd;
            color: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-tabs .nav-link:hover {
            background: #0d6efd;
            color: #fff;
        }

        /* Optional: content box */
        .tab-content {
            border: 1px solid #dee2e6;
            border-top: none;
            padding: 1rem;
            border-radius: 0 0 0.5rem 0.5rem;
            background: #fff;
        }
    </style>
@endpush
