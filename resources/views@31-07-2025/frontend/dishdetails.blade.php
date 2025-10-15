@extends('layouts.web_layout')
@section('content')
<main>
    <section class="py-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-9">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="">
                                <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_NAME').$fooditems->image }}" class="w-100 rounded-3" style="height: 400px;" alt="food-img" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="p-4 rounded-3 border border-warning">
                                <h2 class="pb-3">{{ ucwords($fooditems->name) }}</h2>
                                <p class="pb-4">{{ ucwords($fooditems->short_desc) }}</p>
                                <div class="duration">
                                    <ul class="list-unstyled d-flex flex-wrap gap-3 gap-md-4">
                                        <li><span class="shadow d-block py-2 px-3 rounded-pill"><i class="fa-solid fa-utensils"></i> {{ $fooditems->type_meal }}</span>
                                        </li>
                                        <li><span class="shadow d-block py-2 px-3 rounded-pill"><i class="fa-regular fa-clock"></i> {{ $fooditems->time }}</span></li>
                                        <li><span class="shadow d-block py-2 px-3 rounded-pill"><i class="fa-regular fa-user"></i>
                                                {{ $fooditems->portions . ' portions' }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                                        <div class="Preparation_details bg-warning-subtle p-3 rounded">
                                            <h3 class="pb-3">Preparation</h3>

                                            {!! $fooditems->prepare !!}
                                        </div>
                                        </div>
                    

                        <div class="col-md-12">
                            <div class="dish_ingredients bg-body-tertiary p-3 rounded">
                                <h3 class="pb-3">Ingredients</h3>
                                <ul class="list-unstyled d-flex gap-3 flex-wrap">
                                    @foreach (explode(';', $fooditems->ingredients) as $data)
                                    <li class="shadow  py-2 px-3 rounded-pill"><i class=" fa-solid fa-hand-point-right pe-2"></i> {{ $data }}
                                    </li>
                                    @endforeach

                                </ul>
                            </div>



                        </div>





                    </div>
                </div>
                {{-- @dd($ketech_data); --}}
                <div class="col-lg-3">
                    <div class="">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="text-center pb-3 popular_text">
                                    <h2>Popular</h2>
                                </div>
                            </div>
                            @foreach ($ketech_data->take(5) as $ketchData)
                            <div class="col-lg-12 col-6 col-md-4">
                                <div class="text-center popular_dish">
                                    <a href="#">
                                    <a href="{{route('dishes_menu', $ketchData->id)}}"><img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_NAME').$ketchData->image }}" class="img-fluid  rounded-circle" style="width: 200px; height:200px" />
                                        <h5>{{ $ketchData->kitchen }}</h5>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="col-lg-12 col-6 col-md-4">
                                    <div class="text-center popular_dish">
                                        <a href="#">
                                            <img src="{{ asset('images/food/favorite_img2.png') }}" class="img-fluid pb-3" />
                            <h5>Italian</h5>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-12 col-6 col-md-4">
                        <div class="text-center popular_dish">
                            <a href="#">
                                <img src="{{ asset('images/food/favorite_img4.png') }}" class="img-fluid pb-3" />
                                <h5>Mexican</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-6 col-md-4">
                        <div class="text-center popular_dish">
                            <a href="#">
                                <img src="{{ asset('images/food/favorite_img5.png') }}" class="img-fluid pb-3" />
                                <h5>French</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-6 col-md-4">
                        <div class="text-center popular_dish">
                            <a href="#">
                                <img src="{{ asset('images/food/favorite_img6.png') }}" class="img-fluid pb-3" />
                                <h5>Indian</h5>
                            </a>
                        </div>
                    </div> --}}
                </div>

            </div>

            
                <!-- <div class="mt-3 bg-body-tertiary p-3 rounded-3">
                    <div>
                        <h5 class="pb-3">Share this recipe at:</h5>
                        <div class="socialbuttons">
                            <ul class="list-unstyled ">
                                
                                    <li>
                                        <a href="https://wa.me/?text=Check out this delicious recipe: {{ $fooditems->name }} {{ urlencode(request()->fullUrl()) }}" target="_blank">
                                            <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                                            WHATSAPP
                                        </a>
                                    </li>
                             
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                            <i class="fab fa-facebook-f" style="color:  #1877F2;"></i>
                                            FACEBOOK
                                        </a>
                                    </li>
                              
                                    <li>
                                        <a href="https://www.pinterest.com/pin/create/button/?url={{ urlencode(request()->fullUrl()) }}&media={{ urlencode(asset('images/food/' . $fooditems->image)) }}&description={{ urlencode($fooditems->name) }}" target="_blank">
                                            <i class="fab fa-pinterest" style="color: #E60023;"></i>
                                            PINTEREST
                                        </a>
                                    </li>
                             
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?text=Check out this delicious recipe: {{ $fooditems->name }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                            <i class="fab fa-twitter" style="color: #1DA1F2;"></i>
                                            TWITTER
                                        </a>
                                    </li>
                               
                                    <li>
                                        <a href="mailto:?subject=Check out this delicious recipe&body=Hey, I found this amazing recipe: {{ $fooditems->name }} {{ urlencode(request()->fullUrl()) }}" target="_blank">
                                            <i class="fa-regular fa-envelope" style="color: #FF0000;"></i>
                                            E-MAIL
                                        </a>
                                    </li>
                               
                            </ul>
                        </div>
                    </div>
                </div> -->
        </div>
        </div>
        </div>
    </section>



    {{-- <section class="pb-5">
            <div class="container">
                <div class="review_taste text-center">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <h5>Did it taste good?</h5>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#">
                                    <i class="fa-solid fa-star"></i></a><a href="#"><i
                                        class="fa-solid fa-star"></i></a><a href="#"><i
                                        class="fa-solid fa-star"></i></a><a href="#"><i
                                        class="fa-solid fa-star"></i></a><a href="#"><i
                                        class="fa-solid fa-star"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>10 votes</h5>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <section class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex gap-3 flex-wrap justify-content-center recipes_list">
                            <a href="#" class="py-2 px-3 rounded-pill shadow-sm">Stew recipes</a>
                            <a href="#" class="py-2 px-3 rounded-pill shadow-sm">Main dishes</a>
                              <a href="#" class="py-2 px-3 rounded-pill shadow-sm">Vegetarian recipes</a>
                            <a href="#" class="py-2 px-3 rounded-pill shadow-sm">Dutch recipes</a>
                            <a href="#" class="py-2 px-3 rounded-pill shadow-sm">Winter recipes</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row g-3 g-lg-5 align-items-center">
                            <div class="col-md-3"><img src="images/user/profile.webp" class="w-100" /></div>
                            <div class="col-md-9">
                                <h3 class="pb-3">Created by Sandra</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi impedit
                                    incidunt molestias a illo recusandae neque facilis, cum delectus. Maxime consequatur
                                    ut
                                    odit amet! Aperiam reprehenderit odio ducimus illo neque?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}


    @include('elements.newsletter')





</main>
@endsection