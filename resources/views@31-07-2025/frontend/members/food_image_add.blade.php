@extends('layouts.web_layout')

@section('content')
<main>
  <section class="py-5 bg-body-tertiary recipes_section">
        <div class="container">
        @foreach($kitchens as $id)
            <div class="pb-4 text-center">
                <h2 class="fw-normal">{{$id->kitchen}}</h2>
            </div>
            <div class="row g-3">
                @foreach ($fooditems as  $kitchen)
                <div class="col-md-4">
                    <div class="rounded-3 shadow-sm">
                        <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_NAME').$kitchen->image }}" class="rounded-top" style="width: 100%; height: 230px;" alt="Recipes_img" />
                        <div class="p-3 bg-white rounded-bottom-3">
                            <h5 class="pb-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{  $kitchen->name }}
                            </h5>
                            <ul class="list-unstyled mb-3 d-flex justify-content-between">
                                <li>
                                    <p class="small"><span class="text-warning pe-2"><i class="fa-solid fa-utensils"></i></span>
                                        {{ $kitchen->type_meal }}
                                    </p>
                                </li>
                                <li>
                                    <p class="small"><span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>{{  $kitchen->time }}</p>
                                </li>
                                <li>
                                    <p class="small"><span class="text-warning pe-2"><i class="fa-regular fa-user"></i></span> {{  $kitchen->portions }}
                                    </p>
                                </li>
                            </ul>
                            <div>
                                <a href="{{ route('dishdetails',[base64_encode ($kitchen->id)]) }}" class="btn btn-primary rounded-pill">{{ __('frontend.view_dish') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>

</main>
@endsection