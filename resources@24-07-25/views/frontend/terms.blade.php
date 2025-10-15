@extends('layouts.web_layout')

@section('content')

<main>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class=" text-center py-4">
                            <h2 class="mb-0">Terms and Conditions</h2>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-muted">
                                Welcome to our website! These Terms and Conditions outline the rules and regulations for
                                the use of our services. By accessing or using this website, you accept and agree to
                                comply with these terms. If you do not agree, please do not use our website.
                            </p>

                            <div class="mb-4">
                                <h4 class="fw-bold">1. Use of the Website</h4>
                                <ul class="list-unstyled ps-3 text-muted">
                                    <li>✔ You agree to use this website only for lawful purposes.</li>
                                    <li>✔ You must not use it in any way that breaches any applicable local, national, or
                                        international law.</li>
                                    <li>✔ You must not attempt to gain unauthorized access to any part of this website
                                        or its associated systems.</li>
                                </ul>
                            </div>

                            <div class="mb-4">
                                <h4 class="fw-bold">2. Privacy Policy</h4>
                                <p class="text-muted">
                                    Your privacy is important to us. Please refer to our <a href="#" class="text-decoration-none text-primary">Privacy Policy</a> for details on how
                                    your personal information is handled. By using this website, you consent to the collection and use of information as outlined in our Privacy Policy.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4 class="fw-bold">3. Intellectual Property</h4>
                                <p class="text-muted">
                                    All content on this website, including text, graphics, logos, images, and software,
                                    is the property of our company or its content suppliers. You may not reproduce,
                                    distribute, or use any content without explicit permission from us.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4 class="fw-bold">4. Limitations of Liability</h4>
                                <p class="text-muted">
                                    We strive to provide accurate information on this website but do not guarantee its
                                    completeness or accuracy. We are not liable for any damages resulting from the use
                                    of this website or the inability to access it.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4 class="fw-bold">5. Modifications to the Terms</h4>
                                <p class="text-muted">
                                    We may revise these Terms and Conditions at any time. Continued use of this website
                                    signifies your acceptance of the updated terms.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h4 class="fw-bold">6. Governing Law</h4>
                                <p class="text-muted">
                                    These terms are governed by and construed in accordance with the laws of <strong>[Your
                                        Country/State]</strong>. Any disputes will be resolved exclusively in the courts of
                                    <strong>[Your Jurisdiction]</strong>.
                                </p>
                            </div>

                            <div>
                                <h4 class="fw-bold">7. Contact Us</h4>
                                <p class="text-muted">
                                    If you have any questions about these Terms and Conditions, please contact us at
                                    <a href="mailto:support@example.com" class="text-decoration-none text-primary">support@example.com</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('elements.newsletter')
</main>
@endsection
