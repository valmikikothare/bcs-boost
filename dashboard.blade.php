@extends('layouts.web_layout')

@section('content')
<section class="py-lg-5 py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('elements.left_navigation')
            </div>

            <div class="col-md-9">
                <h4 class="mb-3 text-success">{{ __('frontend.todays_dish') }}</h4>
                @if ($suggesttion_dish != '' && !empty($suggesttion_dish->fooditems))
                <div class="p-4 rounded-3 border border-warning bg-warning-subtle mb-3 mb-lg-4">
                    <div class="row g-lg-4 g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="">
                                <img src="{{ asset('images/food/' . $suggesttion_dish->fooditems->image) }}" class="w-100 rounded-2" alt="food-img" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <h2 class="pb-4">{{ ucwords($suggesttion_dish->fooditems->name) }}</h2>

                                <ul class="list-unstyled d-flex flex-wrap justify-content-between pb-4">
                                    <li>
                                        <p>
                                            <span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>
                                            {{ ucwords($suggesttion_dish->fooditems->type_meal) }}
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>
                                            {{ $suggesttion_dish->fooditems->time }}
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="text-warning pe-2"><i class="fa-regular fa-user"></i></span>
                                            {{ $suggesttion_dish->fooditems->portions . ucwords(' Portions') }}
                                        </p>
                                    </li>
                                </ul>

                                <p class="pb-4">
                                    {{ ucwords($suggesttion_dish->fooditems->short_desc) }}
                                </p>

                                <div>
                                    <a href="{{ route('dishdetails', [base64_encode($suggesttion_dish->fooditems->id)]) }}" class="btn btn-success btn-lg rounded-pill">{{ __('frontend.view_dish') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="p-4 rounded-3 border border-warning bg-warning-subtle mb-3 mb-lg-4">
                    <div class="row g-lg-4 g-3 align-items-center">

                        <h5 class="text-secondary">No Suggestion Found For Today</h5>
                    </div>
                </div>
                @endif
                <h4 class="mb-3 text-success">{{ __('frontend.days') }}</h4>
                <div class="row g-2 g-lg-3">
    @if (!empty($lastsevendays_dish) && count($lastsevendays_dish) > 0)
        @foreach ($lastsevendays_dish as $item)
            @if (!empty($item->fooditems) && $item->fooditems != "")
                <div class="col-12">
                    <div class="p-3 rounded-3 border bg-light-subtle">
                        <div class="row g-lg-4 g-3 align-items-center">
                            <div class="col-md-3">
                                <div>
                                    @if (!empty($item->fooditems->image) && $item->fooditems->image != "")
                                        <img src="{{ asset('images/food/' . $item->fooditems->image) }}" class="w-100 rounded-2" alt="food-img" />
                                    @else
                                        <img src="{{ asset('images/placeholder-image.jpg') }}" class="w-100 rounded-2" alt="food-img" />
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <h5 class="pb-3">
                                        {{ ucwords($item->fooditems->name) }}
                                    </h5>

                                    <ul class="list-unstyled d-flex flex-wrap justify-content-between pb-3">
                                        <li>
                                            <p>
                                                <span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>
                                                {{ ucwords($item->fooditems->type_meal) }}
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>
                                                {{ $item->fooditems->time }}
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                <span class="text-warning pe-2"><i class="fa-regular fa-user"></i></span>
                                                {{ $item->fooditems->portions . ' Portions' }}
                                            </p>
                                        </li>
                                    </ul>

                                    <div class="fs-5">
                                        <span class="badge bg-info">{{ date('m-d-Y', strtotime($item->date)) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-end d-flex flex-column gap-2 ps-3">
                                    <a href="{{ route('dishfeedback', [base64_encode($item->fooditems->id)]) }}" class="btn btn-warning btn-sm rounded-pill">{{ __('frontend.feedback') }}</a>
                                    <a href="{{ route('dishdetails', [base64_encode($item->fooditems->id)]) }}" class="btn btn-success btn-sm rounded-pill">{{ __('frontend.view_dish') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="p-4 rounded-3 border border-warning bg-warning-subtle mb-3 mb-lg-4">
            <div class="row g-lg-4 g-3 align-items-center">
                <h5 class="text-secondary">No Suggestions Found For Last 7 Days</h5>
            </div>
        </div>
    @endif
</div>

            </div>
        </div>
</section>
@endsection