<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session Cancellation Approved</title>
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
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .email-header {
            background-color: #343a40; /* dark gray for cancellation */
            color: #ffffff;
            padding: 25px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        .email-body {
            padding: 25px;
            font-size: 15px;
            line-height: 1.6;
        }

        .highlight-box {
            background-color: #f9f9f9;
            border-left: 4px solid #343a40;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 15px;
            color: #444;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #343a40;
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

        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 15px;
                font-size: 14px;
            }
            .highlight-box {
                font-size: 14px;
            }
            .button {
                display: block;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            Session Cancellation Approved
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Hello {{ $user->name }},</h2>
            <p>Your request to cancel a session has been <strong>approved</strong>.</p>

            <div class="highlight-box">
                <p><strong>Session:</strong> {{ $slot->name }}<br>
                   <strong>Date:</strong> {{ \Carbon\Carbon::parse($slot->getRawOriginal('date'))->format('M d, Y') }}<br>
                   <strong>Time:</strong> {{ \Carbon\Carbon::parse($slot->getRawOriginal('start_time'))->format('h:i A') }} – {{ \Carbon\Carbon::parse($slot->getRawOriginal('end_time'))->format('h:i A') }}
                </p>
            </div>

            <p>If you need assistance or wish to book another session, please visit our platform.</p>

            <a href="https://bcs-boost.mit.edu/" class="button" target="_blank">Visit BOOST Website</a>

            <p style="margin-top:25px;">Thank you,<br>
            <strong>The {{ config('app.name') }} Team</strong></p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
