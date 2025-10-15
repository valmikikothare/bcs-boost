@extends('layouts.admin_main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between bg-dark px-4 py-3">
                <h4 class="text-white m-0">Manage Cancellation Requests</h4>
            </div>

            <div class="bg-white shadow py-4 px-4 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th>S.No</th>
                                <th>User Name</th>
                                <th>Slot Name</th>
                                <th>Status</th>
                                <th>Requested At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancellationRequests as $index => $request)
                                <tr id="cancelRow_{{ $request->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $request->user->name ?? 'N/A' }}</td>
                                    <td>{{ $request->slot->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($request->cancellation_status == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($request->cancellation_status == 1)
                                            <span class="badge bg-success">Confirmed</span>
                                        @endif
                                    </td>
                                    <td>{{ $request->created_at->format('M d, Y ') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                id="actionMenu{{ $request->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $request->id }}">
                                                <li>
                                                    <form
                                                        action="{{ route('cancellation_requests.approve', $request->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT') {{-- Spoof the PUT method --}}
                                                        <button type="submit" class="dropdown-item text-dark"
                                                            @if ($request->cancellation_status == 1) disabled @endif>
                                                            Confirm Request
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
