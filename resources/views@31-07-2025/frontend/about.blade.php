@extends('layouts.web_layout')

@section('content')

<main>
    <!-- About Us Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="text-dark fw-bold">About Us</h1>
                <p class="text-muted">Learn more about our journey, values, and what drives us forward.</p>
            </div>

            <div class="row g-4 align-items-center">
                <!-- Text Content -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <h4 class="text-primary pb-3">Who We Are</h4>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem molestiae temporibus vitae autem tempora officiis recusandae. Ducimus beatae animi dolorum officia quisquam laboriosam in nam iste placeat sint perspiciatis.
                        </p>
                        <p class="text-muted">
                            Our mission is to bring value, excellence, and innovation to everything we do. From our humble beginnings to our current position as a trusted leader in the industry, we have remained committed to delivering outstanding services to our customers.
                        </p>
                        <a href="#values" class="btn btn-primary mt-3 px-4 py-2">Learn More</a>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="col-md-6">
                    <div class="rounded shadow">
                        <img src="{{ asset('images/aboutusimg.webp') }}" alt="About Us" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section id="values" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-dark fw-bold">Our Core Values</h2>
                <p class="text-muted">The principles that guide everything we do.</p>
            </div>

            <div class="row g-4">
                <!-- Value 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100">
                        <div class="card-body">
                            <i class="fa-solid fa-lightbulb fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Innovation</h5>
                            <p class="text-muted">We thrive on creating new solutions to meet evolving challenges.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100">
                        <div class="card-body">
                            <i class="fa-solid fa-people-group fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Teamwork</h5>
                            <p class="text-muted">Collaboration is at the heart of our success.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100">
                        <div class="card-body">
                            <i class="fa-solid fa-award fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Excellence</h5>
                            <p class="text-muted">We deliver nothing but the best to our customers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-dark fw-bold">Meet Our Team</h2>
                <p class="text-muted">The passionate individuals who drive our success.</p>
            </div>

            <div class="owl-carousel owl-theme">
                <!-- Team Member 1 -->
                <div class="item text-center">
                    <img src="{{ asset('images/aboutusimg.webp') }}" alt="Team Member" class=" mb-3" width="120">
                    <h5 class="fw-bold">John Doe</h5>
                    <p class="text-muted">CEO</p>
                </div>

                <!-- Team Member 2 -->
                <div class="item text-center">
                    <img src="{{ asset('images/aboutusimg.webp') }}" alt="Team Member" class=" mb-3" width="120">
                    <h5 class="fw-bold">Jane Smith</h5>
                    <p class="text-muted">Marketing Head</p>
                </div>

                <!-- Team Member 3 -->
                <div class="item text-center">
                    <img src="{{ asset('images/aboutusimg.webp') }}" alt="Team Member" class=" mb-3" width="120">
                    <h5 class="fw-bold">Alice Brown</h5>
                    <p class="text-muted">CTO</p>
                </div>
            </div>
        </div>
    </section>

    @include('elements.newsletter')
</main>

<!-- Owl Carousel Script -->
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1200: { items: 3 }
        }
    });
</script>

@endsection
