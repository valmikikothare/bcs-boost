@extends('layouts.admin_main')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('auth.verify_your_email_address') }}</p>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
            {{ __('auth.a_fresh_verification_link_has_been_sent_to_your_email_address') }}
            </div>
        @endif

        {{ __('auth.before_proceeding_please_check_your_email_for_a_verification_link') }}
        {{ __('auth.if_you_did_not_receive_the_email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-primary btn-block">{{ __('auth.click_here_to_request_another') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
