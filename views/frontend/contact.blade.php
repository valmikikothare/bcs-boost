@extends('layouts.web_layout')

@section('content')
<main>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fs-2 fw-bold">{{ __('frontend.contact_us') }}</h1>
                <p class="text-muted">{{ __('frontend.inqueries') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4 text-primary">Get in Touch</h3>
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
                                        class="btn btn-primary py-2 px-4 w-25">{{ __('frontend.send_message') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

</main>
@endsection