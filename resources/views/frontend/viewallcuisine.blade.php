@extends('layouts.web_layout')

@section('content')


<section class="py-5">
        <div class="container">
            <div class="pb-5 text-center">
                <h2>{{ __('frontend.favorite_cuisines') }}</h2>
            </div>
            <div class="row g-3">
                @foreach($kitchens as $kitchen)
                <div class="col-md-4 col-lg-2 col-sm-6">
                    <div class="text-center">
                    <a href="{{route('dishes_menu', $kitchen->id)}}"><img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_NAME').$kitchen->image }}" class="rounded-circle mb-3" style="height: 180px !important;width: 180px !important;  object-fit: cover;" alt="American-food-img" /></a>
                        <h5>{{ $kitchen->kitchen }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
           
        </div>
    </section>


@endsection