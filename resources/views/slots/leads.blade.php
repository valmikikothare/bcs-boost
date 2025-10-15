@extends('layouts.admin_main')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between bg-dark px-4 py-3">
            <div>
                <h4 class="text-white m-0">Leads for Slot: {{ $slot->name }}</h4>
            </div>
            <div>
                <button class="btn btn-secondary" onclick="window.history.back();">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>
        </div>
        <div class="bg-white shadow py-4 px-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Short Description</th>
                        <th>Description</th>
                        <th>Detail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                        <tr>
                            <td>{{ optional($lead->user)->name }}</td>
                            <td>{{ optional($lead->user)->email }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($lead->agenda, 15, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($lead->description, 25, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($lead->other_details, 25, '...') }}</td>


                            <td>
                                @if ($lead->status == 1)
                                    <button class="btn btn-success btn-sm" disabled>Approved</button>
                                @elseif ($lead->status == 2)
                                    <button class="btn btn-danger btn-sm" disabled>Rejected</button>
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveLead({{ $lead->id }})">Approve</button>
                                @else
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveLead({{ $lead->id }})">Approve</button>
                                @endif
                                <button class="btn btn-info btn-sm" onclick="viewDetails({{ $lead }})">View</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Lead Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>User:</strong> <span id="modalUser"></span></p>
                    <p><strong>Short Description:</strong> <span id="modalAgenda"></span></p>
                    <p><strong>Detailed Description:</strong> <span id="modalDescription"></span></p>
                    <p><strong>Detaile:</strong> <span id="modaldetail"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Loader in your blade -->
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
    <script>
        function approveLead(leadId) {
            Swal.fire({
                title: "Are you sure?",
                html: `
                    <p>Are you sure you want to change the lead?<br>
                    If you change the lead then all attendees will be removed and this will be shown as the new session.</p>
                    <div class="form-check text-start mt-3">
                        <input type="checkbox" id="sendMail" class="form-check-input">
                        <label for="sendMail" class="form-check-label">Send the mail to the attendees</label>
                    </div>
                `,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                focusConfirm: false,
                preConfirm: () => {
                    return document.getElementById("sendMail").checked ? 1 : 0;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let sendMail = result.value;

                    // Show loader
                    document.getElementById('loader').style.display = 'flex';

                    $.ajax({
                        url: '{{ url('slots/leads') }}/' + leadId + '/approve',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            sendMail: sendMail
                        },
                        success: function(response) {
                            // Hide loader
                            document.getElementById('loader').style.display = 'none';

                            if (response.success) {
                                Swal.fire('Success', response.message, 'success').then(() => {
                                    location.reload(); // Reload to show updated status
                                });
                            } else {
                                Swal.fire('Error', response.message || 'Something went wrong!',
                                'error');
                            }
                        },
                        error: function(xhr) {
                            // Hide loader
                            document.getElementById('loader').style.display = 'none';
                            Swal.fire('Error', 'Something went wrong!', 'error');
                        }
                    });
                }
            });
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function approveSlot(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Once approved, this slot will be marked as approved.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/slots/${id}/approve`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Approved', response.message, 'success').then(() => {
                                    location.reload(); // Reload the page to reflect changes
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Something went wrong!', 'error');
                        },
                    });
                }
            });
        }
    </script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function viewDetails(lead) {
            // Populate modal fields
            document.getElementById('modalUser').innerText = lead.user.name;
            document.getElementById('modalAgenda').innerText = lead.agenda;
            document.getElementById('modalDescription').innerText = lead.description;
            document.getElementById('modaldetail').innerText = lead.other_details;

            // Initialize and show the modal
            var detailsModal = new bootstrap.Modal(document.getElementById('detailsModal'));
            detailsModal.show();
        }
    </script>
@endsection
