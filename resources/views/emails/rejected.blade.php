<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session Lead Application Rejected</title>
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
            max-width: 650px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #e6e6e6;
            overflow: hidden;
        }
        .header {
            background-color: #dc3545;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 25px;
        }
        .details {
            background: #f9f9f9;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 20px 0;
            border-radius: 6px;
            font-size: 14px;
        }
        .details p {
            margin: 6px 0;
        }
        .footer {
            background-color: #f8f8f8;
            padding: 15px;
            font-size: 13px;
            text-align: center;
            color: #888888;
            border-top: 1px solid #e6e6e6;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <h1>Session Lead Application Rejected</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hello {{ $lead->user->name ?? 'User' }},</p>

            <p>We appreciate your interest in leading a session. Unfortunately, your request for the slot
                <strong>{{ $lead->slot->name ?? 'N/A' }}</strong> has been <strong style="color:#dc3545;">rejected</strong>.
            </p>

            <p>Below are the details of your submission:</p>

            <!-- Full Session Lead Details -->
            <div class="details">
                <p><strong>Slot Name:</strong> {{ $lead->slot->name ?? 'N/A' }}</p>
                <p><strong>Short Description:</strong> {{ $lead->agenda ?? 'N/A' }}</p>
                <p><strong>Description:</strong> {{ $lead->description ?? 'N/A' }}</p>
                <p><strong>Background knowledge expected:</strong> {{ $lead->other_details ?? 'N/A' }}</p>
                <p><strong>Status:</strong> Rejected</p>
                <p><strong>Requested At:</strong> {{ $lead->created_at ? $lead->created_at : 'N/A' }}</p>
                
            </div>

            <p>You may try submitting another request for a different slot that’s available.</p>

            <p style="font-size: 14px; color: #555; margin: 20px 0;">
                <a href="https://bcs-boost.mit.edu/" target="_blank">Browse Available Slots</a>
            </p>

            <p>Best regards,<br>
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
