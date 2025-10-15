<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Slot Cancellation</title>
</head>

<body>
    <p>Dear {{ $user->name }},</p>

    <p>We regret to inform you that the following Slot has been cancelled:</p>

    <ul>
        <li><strong>Session Title:</strong> {{ $slot->name ?? 'N/A' }}</li>
        <li><strong>Date:</strong> {{ $slot->date }}</li>
        <li><strong>Time:</strong> {{ $slot->start_time }} - {{ $slot->end_time }}</li>
    </ul>


    <p>If you have any questions, please contact our support team.</p>

    <p>Thank you,<br>
        {{ config('app.name') }}</p>
</body>

</html>
