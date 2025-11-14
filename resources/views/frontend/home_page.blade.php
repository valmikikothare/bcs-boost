@extends('layouts.web_layout')
@section('content')

<main>
    <!-- Hero Section -->
    <section class="hero-section bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to BOOST</h1>
            <p class="lead mt-3">Building Opportunities For Open Sharing and Teaching</p>
            @if(auth()->check() && auth()->user()->id)
            <a href="{{ route('user.my_sessions') }}"
                class="btn btn-success btn-lg mt-4 px-5">{{ __('frontend.session') }}</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-light btn-lg mt-4 px-5">{{ __('frontend.login') }}</a>
            @endif

        </div>
    </section>

    <section class="features-section py-5">
        <div class="container">
            <div class="row text-center">

                <div class="col-lg-12">
                    <div class="faciliateCon">
                        <p>BOOST is designed to facilitate the organization and management of in-person gatherings among
                            the members
                            of the MIT Department of Brain and Cognitive Science community with the purpose of helping
                            each other with
                            various software, coding, and engineering skills. This platform provides the means for
                            individuals to
                            volunteer to lead sessions, and others to register and attend their sessions of interest.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!-- Interactive Section -->


    <!-- Carousel Section -->

</main>

<!-- Styling -->
<style>
    .feature-card img {
        display: block;
        margin: 0 auto;
    }

    .feature-card h4 {
        margin-top: 15px;
    }

    .feature-card p {
        margin: 10px 0 0;
    }

    .owl-carousel .item {
        text-align: center;
    }

    .owl-carousel .item img {
        max-height: 200px;
        margin: 0 auto;
    }
</style>
@endsection