@extends('layouts.web_layout')

@section('content')
<main>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5 px-5">
                <h1 class="fs-1 fw-bold text-primary">How to Use This Site</h1>
                <p class="text-muted fs-5">Welcome to our platform! This guide will help you understand how to use the key features of the site effectively. The platform is designed to manage sessions and slots for both users and administrators.</p>
            </div>

            <div class="row g-4">
                <!-- User Guide Section -->
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">
                            <h2 class="text-primary mb-4">For Users</h2>

                            <div class="mb-5">
                                <h4 class="fw-semibold">1. Sign Up / Sign In</h4>
                                <ul class="list-unstyled ps-3">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Create a new account or log in to your existing account.</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Update your personal details in the <strong>Profile</strong> section.</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Change your password anytime in the <strong>Change Password</strong> section.</li>
                                </ul>
                            </div>

                            <div class="mb-5">
                                <h4 class="fw-semibold">2. Lead a Session</h4>
                                <ul class="list-unstyled ps-3">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Navigate to the <strong>Lead a Session</strong> section in the left navigation panel.</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>View all available slots and click the <strong>Reserve a Slot</strong> button for your desired slot.</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Fill out the popup form with the following details:
                                        <ul class="list-unstyled ps-4">
                                            <li>- <strong>Short Description</strong></li>
                                            <li>- <strong>Description</strong></li>
                                            <li>- <strong>Background Knowledge Expected</strong></li>
                                        </ul>
                                    </li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Submit your request. Your request will display as <strong>Approval Pending</strong> until reviewed by the admin.</li>
                                </ul>
                            </div>

                            <div class="mb-5">
                                <h4 class="fw-semibold">3. Check Lead Management</h4>
                                <ul class="list-unstyled ps-3">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Once your session request is approved by the admin:
                                        <ul class="list-unstyled ps-4">
                                            <li>- It will appear in the <strong>Lead Management</strong> section.</li>
                                            <li>- The session status will display as either <strong>Approved</strong> or <strong>Completed</strong>.</li>
                                            <li>- Admin has the ability to mark your session as complete.</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="fw-semibold">4. Book a Session</h4>
                                <ul class="list-unstyled ps-3">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Navigate to the <strong>Book a Session</strong> section to view sessions led by others.</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Select a session and reserve your spot.</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>If the session is overbooked:
                                        <ul class="list-unstyled ps-4">
                                            <li>- Your booking will be marked as <strong>Pending</strong>.</li>
                                            <li>- If a confirmed user cancels their booking, pending bookings will automatically move to <strong>Confirmed</strong>.</li>
                                        </ul>
                                    </li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Confirmed bookings appear in the <strong>Booking History</strong> section.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

             
            </div>
        </div>
    </section>
</main>
@endsection
