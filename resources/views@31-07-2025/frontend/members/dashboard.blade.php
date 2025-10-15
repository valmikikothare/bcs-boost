@extends('layouts.web_layout')

@section('content')
<section class="hero-section bg-primary text-white text-center py-5">
    <div class="container">
      <h1 class="display-4">Welcome to BOOST</h1>
      <p class="lead mt-3">Building opportunities for open sharing and teaching</p>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4">
          <div class="feature-card p-4 bg-light shadow-sm rounded">
            <img src="http://127.0.0.1:8000/images/aboutusimg.webp" alt="Feature 1" class="mb-3" width="80">
            <h4 class="text-primary">Innovative Tools</h4>
            <p>Access cutting-edge tools to achieve your goals efficiently.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 bg-light shadow-sm rounded">
            <img src="http://127.0.0.1:8000/images/aboutusimg.webp" alt="Feature 2" class="mb-3" width="80">
            <h4 class="text-primary">Expert Guidance</h4>
            <p>Learn from industry experts and enhance your skills.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card p-4 bg-light shadow-sm rounded">
            <img src="http://127.0.0.1:8000/images/aboutusimg.webp" alt="Feature 3" class="mb-3" width="80">
            <h4 class="text-primary">Tailored Solutions</h4>
            <p>Discover solutions tailored to your specific needs.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection