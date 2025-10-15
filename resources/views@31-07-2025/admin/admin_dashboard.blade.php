@extends('layouts.admin_main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">


<div class="content mx-2">
    <div class="container-fluid bg-white shadow px-3">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="py-2">{{ __('admin.dashboard') }}</h3>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$userCount}}</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('users.index') }}" class="small-box-footer">{{ __('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$slotCount}}</h3>
                        <p>Total Slots</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('slots.index') }}" class="small-box-footer">{{ __('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$completed_slot}}</h3>
                        <p>Completed Slots</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('slots.index') }}" class="small-box-footer">{{ __('admin.more_info') }}<i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>



            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$pending_slot}}</h3>
                        <p>Pending Slots</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('slots.index') }}" class="small-box-footer">{{ __('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="wrapper">
            <div class="row">
                <!-- Recently Added Users -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title text-bold text-white">Recently Added Users</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentUsers as $key => $user)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{ucfirst($user->name)}}</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Available Slots -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title text-bold text-white">Available Slots</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>No. of Attendees</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentSlot as $key => $slot)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$slot->name}}</td>
                                            <td>{{$slot->no_of_attendees}}</td>
                                            <td>{{$slot->date}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>






</div>
{{--
<script src="{{ asset('js/calander.js') }}"></script> --}}
<!-- /.content -->
@endsection