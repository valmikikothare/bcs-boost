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

                        {{-- Filter Form --}}
                        <form method="GET" class="row g-3 mb-3">
                            <div class="col-md-4">
                                <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        @if ($allSlots->isEmpty())
                            <div class="alert alert-warning">No sessions found.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Your Role</th>
                                            <th>Status</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allSlots as $slot)
                                            <tr>
                                                <td>{{ $slot->name }}</td>
                                                <td>{{ $slot->date }}</td>
                                                <td>{{ $slot->start_time }} - {{ $slot->end_time }}</td>
                                                <td>{{ $slot->role }}</td>
                                                <td>
                                                    @php
                                                        $lead = $slot->sessionLeads->first(); // For the current user only

                                                        $statusText = 'Pending';
                                                        $statusClass = 'warning';

                                                        if ($lead) {
                                                            if ($lead->status == 1) {
                                                                $statusText = 'Approved';
                                                                $statusClass = 'success';
                                                            } elseif ($lead->status == 2) {
                                                                $statusText = 'Rejected';
                                                                $statusClass = 'danger';
                                                            } elseif ($lead->status == 3) {
                                                                $statusText = 'Completed';
                                                                $statusClass = 'success';
                                                            }
                                                        }
                                                    @endphp

                                                    <span class="badge bg-{{ $statusClass }}">
                                                        {{ $statusText }}
                                                    </span>


                                                </td>
                                                {{-- <td>{{ $slot->description }}</td> --}}
                                                <td>
                                                    @if ($slot->role === 'Participant')
                                                        <div class="dropdown" style="cursor: pointer;">
                                                            <i class="fa-solid fa-ellipsis-vertical"
                                                                id="dropdownMenuButton{{ $slot->id }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton{{ $slot->id }}">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('user.cancelBookingById', ['id' => $slot->booking_id, 'slot_id' => $slot->id]) }}">
                                                                        Cancel Booking
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
