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



    <section class="py-5 bg-light d-none">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fs-2 fw-bold">{{ __('frontend.contact_us') }}</h1>
                <p class="text-muted">{{ __('frontend.inqueries') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="">
                        <img src="{{ asset('images/contact-us-img1.jpg')}}" alt="" class="rounded-3 w-100">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <!-- <h3 class="fw-bold mb-4 text-primary">Get in Touch</h3> -->
                            <form method="GET" action="{{ route('Contact_Data') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control py-3 shadow-sm" name="name"
                                        placeholder="{{ __('frontend.your_name') }}" required maxlength="50">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control py-3 shadow-sm" name="email"
                                        placeholder="{{ __('frontend.your_email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control py-3 shadow-sm" name="message"
                                        placeholder="{{ __('frontend.your_message') }}" rows="5" required></textarea>
                                    <div class="char-count text-end text-muted mt-1" style="display: none;">200
                                        characters remaining</div>
                                </div>
                                <div class="text-end">
                                    <button type="submit"
                                        class="btn btn-primary py-2 px-4 w-100">{{ __('frontend.send_message') }}</button>
                                </div>
                            </form>
                        </div>
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