<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Hello {{ ucfirst($user->name) }},</h2>

    <p>Your booking for the following session has been confirmed:</p>

    <ul>
        <li><strong>Session Name:</strong> {{ ucfirst($slot->name) }}</li>
        <li><strong>Date:</strong> {{ $slot->date }}</li>
        <li><strong>Time:</strong> {{ $slot->start_time }} - {{ $slot->end_time }}</li>
        <li><strong>Agenda:</strong> {{ $slot->sessionLeads->agenda ?? 'N/A' }}</li>
    </ul>

    <p>Thank you for booking!</p>
</body>
</html>
