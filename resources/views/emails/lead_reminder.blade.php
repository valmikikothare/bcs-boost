<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Session Reminder</title>
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
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
        }

        .email-header {
            background-color: #2e7d32;
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

        .email-body p {
            margin-bottom: 16px;
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
            Session Reminder
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Dear {{ $name ?? 'Leader' }},</p>

            <p>Thank you for volunteering to lead a <strong>BOOST session</strong>!</p>

            <p>This is a reminder that your session is scheduled for <strong>{{ $sessionDateTime ?? 'your scheduled time' }}</strong>.</p>

            <p>Please also be sure to post a brief description of your talk on the BOOST Slack channel to help generate interest and engagement.</p>

            <p>Looking forward to your session!</p>

            <p>
                You can visit the 
                <a href="https://bcs-boost.mit.edu/" target="_blank" style="color:#2563eb;">Boost website</a> 
                for more details and updates.
            </p>

            <p>Thank you,<br>
            <strong>{{ config('app.name') }}</strong></p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>
