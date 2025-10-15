@extends('layouts.admin_main')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between bg-dark px-4 py-3">
            <div>
                <h4 class="text-white m-0">Attendees Details</h4>
            </div>
      
        </div>
        <div class="bg-white shadow py-4 px-4">
            <div class="card-body p-0">
                <div class="table-responsive">

                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Slot Name</th>
                                <th>Attendees Name</th>
                                <th>Attendees Email</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>    
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($attendees_list->bookinghistory) > 0)
                                @foreach ($attendees_list->bookinghistory as $attendees)

                                    <tr id="slotRow_{{ $attendees->id }}">
                                        <td>{{ ucfirst($attendees_list->name) }}</td>
                                        <td>{{ ucfirst($attendees->user->name)}}</td>
                                        <td>{{ $attendees->user->email}}</td>
                                        <td>{{ $attendees_list->date }}</td>
                                        <td>{{ $attendees_list->start_time }}</td>
                                        <td>{{ $attendees_list->end_time }}</td>
                                        <td>
                                            @if($attendees->status == 1)
                                                <p class="badge badge-success">Booked Confirmed</p>
                                            @else
                                                <p class="badge badge-danger">Pending</p>
                                            @endif
                                        </td>
                                        <td>


                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td  colspan="7">
                                        <div class="text-center">
                                            <p>No Record Found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection