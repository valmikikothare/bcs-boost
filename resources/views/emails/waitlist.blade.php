<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e6e6e6;
            overflow: hidden;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #d9534f;
            margin-top: 0;
        }

        .footer {
            background-color: #f8f8f8;
            padding: 15px;
            font-size: 13px;
            text-align: center;
            color: #888888;
            border-top: 1px solid #e6e6e6;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <div style="background-color:#cad620; color:#ffffff; padding:20px; text-align:center;">
            <h1 style="margin:0; font-size:22px; color:#ffffff;">
                Session Waitlist Notification
            </h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello {{ $user->name }},</p>

            <h2>❗ Session at Capacity</h2>

            <p>
                The session <strong>"{{ $slot->name ?? 'Session' }}"</strong> has reached its maximum capacity.
                You have been placed on the waitlist and will be notified if a spot becomes available.
            </p>

            <p>
                For the latest updates and more details, please visit our website:
            </p>

            <p style="text-align: center; margin-top: 20px;">
                <a href="https://bcs-boost.mit.edu/">https://bcs-boost.mit.edu/</a>
            </p>

            <p>
                We truly appreciate your interest and patience.<br>
                Thank you for being a valued part of our community.
            </p>

            <p>
                Best regards,<br>
                <strong>The {{ config('app.name') }} Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>

    </div>
</body>

</html>
