@component('mail::message')
    # Lead Cancellation Request

    Hello **{{ $admin->name }}**,

    We would like to inform you that a user has submitted a **lead cancellation request**.
    Please review the request details below:

    ---

    ### 📌 Request Details:
    - **User:** {{ $requestedUser->name }} ({{ $requestedUser->email }})
    - **Session Title:** {{ $slot->name ?? 'N/A' }}
    - **Date:** {{ ($slot->date) }}
    - **Time:** {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} –
    {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}


    Thank you for your prompt attention to this matter.

    Best regards,
    **The {{ config('app.name') }} Team**

    For more information, please visit our platform:
   https://bcs-boost.mit.edu/
@endcomponent
