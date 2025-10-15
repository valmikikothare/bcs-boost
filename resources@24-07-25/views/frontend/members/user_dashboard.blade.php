@extends('layouts.web_layout')

@section('content')
<style>
    /* General Dashboard Styles */
    .dashboard_section {
        background-color: #f8f9fa;
    }

    .dashboard-header {
        text-align: left;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .dashboard-card {
        border-radius: 10px;
        transition: transform 0.2s ease-in-out;
    }

    .dashboard-card:hover {
        transform: scale(1.05);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-number {
        font-size: 3rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 0.9rem;
    }

    .table-responsive {
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        text-align: center;
    }

    .table tbody td {
        text-align: center;
        font-size: 0.95rem;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.8em;
        border-radius: 5px;
    }
</style>
<div class="">
    <section class="py-3 dashboard_section">
        <div class="container-fluid px-5">
            <div class="row">
                <!-- Left Navigation -->
                <div class="col-md-3">
                    @include('elements.left_navigation')
                </div>

                <!-- Dashboard Section -->
                <div class="col-md-9">
                    <div class="bg-white shadow p-4">
                        <div class="dashboard-header mb-4">
                            <h2 class="dashboard-title">Welcome Back, {{ ucfirst(Auth::user()->name) }}!</h2>
                            <p class="text-muted">Here’s what’s happening today</p>
                        </div>

                        <!-- Dashboard Cards -->
                        <div class="row g-4">
                            <!-- Example Card 1 -->
                            <div class="col-md-6">
                                <div class="dashboard-card bg-primary text-white p-4 rounded shadow-sm">
                                    <h4 class="card-title">Approved Slots</h4>
                                    <h2 class="card-number">{{$approvedSlotCount}}</h2>
                                    <!-- <p class="card-text">Slots scheduled this week</p> -->
                                </div>
                            </div>

                            <!-- Example Card 2 -->
                            <!-- <div class="col-md-4">
                                <div class="dashboard-card bg-success text-white p-4 rounded shadow-sm">
                                    <h4 class="card-title">Completed Sessions</h4>
                                    <h2 class="card-number">8</h2>
                                    <p class="card-text">Successfully completed</p>
                                </div>
                            </div> -->

                            <!-- Example Card 3 -->
                            <div class="col-md-6">
                                <div class="dashboard-card bg-warning text-white p-4 rounded shadow-sm">
                                    <h4 class="card-title">Approval Pending Slots</h4>
                                    <h2 class="card-number">{{$pendingSlotCount}}</h2>
                                    <!-- <p class="card-text">Awaiting your feedback</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <div>
                                    <h4 class="mb-3">Recent Lead Sessions</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Session Title</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($recentleadsessions) > 0)
                                                    @foreach ($recentleadsessions as $key => $recentleadsession)
                                                        <tr>
                                                            <td>{{++$key}}</td>
                                                            <td>{{$recentleadsession->slot->name}}</td>
                                                            <td>{{$recentleadsession->created_at}}</td>
                                                            <td>
                                                                @if($recentleadsession->status == 1)
                                                                    <span class="badge bg-success">Approved</span>
                                                                @else
                                                                    <span class="badge bg-success">Pending</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colSpan="4">
                                                            <div class="text-center">
                                                                <p>No Record yet.</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <h4 class="mb-3">Recent Booked Sessions</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Session Title</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($recentBookings) > 0)
                                                    @foreach ($recentBookings as $key => $recentBooking)
                                              
                                                        <tr>
                                                            <td>{{++$key}}</td>
                                                            <td>{{$recentBooking->slot->name}}</td>
                                                            <td>{{$recentBooking->created_at}}</td>
                                                            <td> @if($recentBooking->status == 1)
                                                                <span class="badge bg-success">Booking Confirmed</span>
                                                            @else
                                                                <span class="badge bg-success">Booking Pending</span>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colSpan="4">
                                                            <div class="text-center">
                                                                <p>No Record yet.</p>
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection