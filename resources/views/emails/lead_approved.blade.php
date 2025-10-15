<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lead Request Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 650px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
        }

        .email-header {
            background-color: #16a34a;
            /* green for success */
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .email-body {
            padding: 25px;
            font-size: 15px;
            line-height: 1.6;
        }

        .highlight-box {
            background-color: #f9f9f9;
            border-left: 4px solid #16a34a;
            padding: 12px;
            margin: 15px 0;
            border-radius: 5px;
            font-size: 14px;
            color: #444;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #16a34a;
            color: #fff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }

        .email-footer {
            background-color: #f4f6f8;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            Lead Request Approved
        </div>

        <!-- Body -->
        <div class="email-body">
            <h1>Hello {{ $lead->user->name ?? 'User' }},</h1>

            <p>We are pleased to inform you that your request to lead a session has been <strong>approved</strong>.</p>

            <p>Here are your slot details:</p>
            <div class="highlight-box">
                <p>
                    <strong>Slot Name:</strong> {{ $lead->slot->name ?? 'N/A' }} <br>
                    <strong>Status:</strong>
                    @if ($lead->status == 1)
                        Approved
                    @elseif($lead->status == 0)
                        Pending
                    @else
                        Rejected
                    @endif
                    <br>
                    <strong>Short Description:</strong> {{ $lead->agenda ?? 'N/A' }} <br>
                    <strong>Description:</strong> {{ $lead->description ?? 'N/A' }} <br>
                    <strong>Background knowledge expected:</strong> {{ $lead->other_details ?? 'N/A' }} <br>
                    {{-- <strong>Requested By:</strong> {{ $lead->user->name ?? 'N/A' }} <br> --}}
                    <strong>Slot Date:</strong>
                    {{ $lead->slot->date ? $lead->slot->date : 'N/A' }} <br>
                    <strong>Start Time:</strong>
                    {{ $lead->slot->start_time ? $lead->slot->start_time : 'N/A' }}
                </p>
            </div>


            <a href="https://bcs-boost.mit.edu/" class="button" target="_blank">View on BOOST</a>

            <p style="margin-top:25px;">Thank you,<br>
                <strong>{{ config('app.name') }} Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>
