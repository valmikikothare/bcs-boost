@extends('layouts.web_layout')

@section('content')
    <main>


    <section class="py-5 faq-section">
            <div class="container">
                <div class="mb-4">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-10 col-lg-8">
                            <div class="mb-3">
                                <div class="mb-4 text-center">
                                    <h2 class="pb-3 fs-2 fw-normal">{{ __('frontend.frequently') }}</h2>
                                </div>

                                <div class="accordion" id="faqAccordion">
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="faqHeading1">
                                            <button class="accordion-button mx-0 collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse1"
                                                aria-expanded="false" aria-controls="faqCollapse1">
                                                What is BOOST?
                                            </button>
                                        </h3>
                                        <div id="faqCollapse1" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">BOOST is designed to facilitate the organization and management of gatherings among the members of the MIT Department of Brain and Cognitive Science community with the purpose of helping each other with various software, coding, and engineering skills. This platform provides the means for individuals to volunteer to lead sessions, and others to register and attend their sessions of interest. </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="faqHeading15">
                                            <button class="accordion-button mx-0 collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse15"
                                                aria-expanded="false" aria-controls="faqCollapse15">
                                                What are some example topics I can teach or learn?
                                            </button>
                                        </h3>
                                        <div id="faqCollapse15" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading15" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                             <p>Here are some suitable examples.</p>
                                             <ul>
                                                <li>Work with GitHub.</li>
                                                <li>Debug Python code like an expert.</li>
                                                <li>Use PyTorch and build NN models.</li>
                                                <li>Work with MIT computing cluster.</li>
                                                <li>Use ChatGPT to improve your code aesthetics and comments.</li>
                                                <li>Use Fusion for 3D printing</li>
                                                <li>Run behavioral experiments online</li>
                                                <li>Use Adobe Illustrator like an expert</li>
                                                <li>Write/debug code for specific models and/or analyses (e.g. Video analysis, Diffusion models, MCMC, etc.) </li>
                                             </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="faqHeading16">
                                            <button class="accordion-button mx-0 collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse16"
                                                aria-expanded="false" aria-controls="faqCollapse16">
                                                When are the sessions held?
                                            </button>
                                        </h3>
                                        <div id="faqCollapse16" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading16" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">We will hold these sessions during lunchtime from 12-1 in Building 46 and will provide lunch to the participants. </div>
                                        </div>
                                    </div>


                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="faqHeading12">
                                            <button class="accordion-button mx-0 collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse12"
                                                aria-expanded="false" aria-controls="faqCollapse12">
                                                How can I check if my topic of interest is relevant? 
                                            </button>
                                        </h3>
                                        <div id="faqCollapse12" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading12" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">Go ahead and propose the topic. The administrator will see your proposal and will approve it if it is deemed suitable. Our broad objective is that proposals are broad-based and there is diversity across topics to attract all members of our community. You can propose something related to coding, a specific package, a productivity tool, a technique in cellular/systems/cognitive/computational neuroscience, and many other things. Don’t shy away. If you think it may be interesting, it probably is. If you have questions, you can send an email to admin@.... </div>
                                        </div>
                                    </div>




                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="faqHeading13">
                                            <button class="accordion-button mx-0 collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse13"
                                                aria-expanded="false" aria-controls="faqCollapse13">
                                                Can I join any session I want?
                                            </button>
                                        </h3>
                                        <div id="faqCollapse13" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading13" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">Each session will have a maximum capacity for participants. We will send invitations to the community in advance and accept up to the maximum number of participants for each session. Several reasons motivate limiting the numbers including the quality of sessions, the availability of space, and the supply of food.  </div>
                                        </div>
                                    </div>


                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="faqHeading14">
                                            <button class="accordion-button mx-0 collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faqCollapse14"
                                                aria-expanded="false" aria-controls="faqCollapse14">
                                                Why are sessions only in-person? 
                                            </button>
                                        </h3>
                                        <div id="faqCollapse14" class="accordion-collapse collapse"
                                            aria-labelledby="faqHeading14" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">We have determined that this mode of communication is more effective for learning and for creating a shared sense of community. </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 






        <!-- @include('elements.newsletter') -->

        {{-- <section class="py-5 bg-body-tertiary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="text-center">
                            <h2 class="fw-normal pb-3"> {{ __('frontend.latest_recipe') }}</h2>
                            <p class="pb-4">{{ __('frontend.recipes_tips') }}</p>

                            <div>
                                <form>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="recipes_email_input position-relative">
                                                <input type="email" class="form-control border-0 shadow-sm rounded-pill"
                                                    placeholder="{{ __('frontend.email_address') }}" />
                                                <button type="submit" class="border-0 bg-white"><i
                                                        class="fa-regular fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}


    </main>

    {{-- <footer></footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            margin: 20,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script> --}}
@endsection
