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
                        <h4 class="mb-3 text-success">All Session Leads</h4>
                        <hr>
                        <form method="GET" action="{{ route('user.leadmanagement') }}" class="mb-4" autocomplete="off">
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
                                <button type="submit" class="btn btn-primary w-100" style="margin-top: 30px;">Filter</button>
                            </div>
                        </div>
                    </form>


                        <!-- Check if there are no slots found -->
                        @if($slots->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No slots found for the selected date range.
                            </div>
                        @else
                        
                            <div class="row g-4">
                                @foreach ($slots as $slot)

                   
                                    <div class="col-md-4">
                                        <div class="bg-white py-4 px-4 shadow">
                                            <div class="card-body d-flex flex-column">
                                                <div class="d-flex justify-content-between">
                                                  <h5 class="card-title pb-3 fw-bold">{{ $slot->name }}</h5>

                                                    <div class="dropdown" style="cursor: pointer;">
                                                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown" aria-expanded="false"></i>

                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        
                                                        <li>
                                                                <a class="dropdown-item viewDetails" 
                                                                href="#" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#slotDetailModal"
                                                                data-name="{{ $slot->name }}"
                                                                data-agenda="{{ $slot->sessionLeads->agenda }}"
                                                                data-description="{{ $slot->sessionLeads->description }}"
                                                                data-date="{{ $slot->date }}"
                                                                data-timing="{{ $slot->start_time }} - {{ $slot->end_time }}"
                                                                data-status="{{ $slot->sessionLeads->status }}">
                                                                View Details
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                <div>
                                    <p>Short Description : {{$slot->sessionLeads->agenda}}</p>
                                </div>
                                                <p class="card-text py-3" style="font-size: 14px;">
                                                    <span class="text-dark h6"><i class="fa-solid fa-calendar-days me-2"></i>Date : </span>
                                                    {{ $slot->date }}
                                                </p>

                                                <p class="card-text" style="font-size: 14px;">
                                                    <span class="text-dark h6"><i class="fa-solid fa-clock me-1"></i>Timing : </span>
                                                    {{ $slot->start_time}} -
                                                    {{ $slot->end_time}}
                                                </p>

                                                <div class="pt-3">
                                             
                                                        @if ($slot->sessionLeads->status == 0)
                                                            <button class="btn btn-warning w-100 px-0 mx-0" disabled>Approval Pending</button>
                                                        @elseif($slot->sessionLeads->status == 1)
                                                            <button class="btn btn-success w-100 px-0 mx-0" disabled>Approved</button>
                                                        @elseif($slot->sessionLeads->status == 2)
                                                            <button class="btn btn-danger w-100 px-0 mx-0" disabled>Rejected</button>
                                                        @elseif($slot->sessionLeads->status == 3)
                                                        <button class="btn btn-success w-100 px-0 mx-0" disabled>Completed</button>
                                                        @endif
                                                  
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>


<!-- Modal -->
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



@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const modalTitle = document.getElementById('modalTitle');
    const modalSlotName = document.getElementById('modalSlotName');
    const modalAgenda = document.getElementById('modalAgenda');
    const modalDescription = document.getElementById('modalDescription');
    const modalDate = document.getElementById('modalDate');
    const modalTiming = document.getElementById('modalTiming');
    const modalStatus = document.getElementById('modalStatus');

    document.querySelectorAll('.viewDetails').forEach(button => {
        button.addEventListener('click', function () {
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