<!DOCTYPE html>
<html>
<head>
    <title>Booking Cancelled</title>
</head>
<body>
    <h2>Hello {{ ucfirst($user->name) }},</h2>

    <p>Your booking for the following session has been <strong>cancelled</strong>:</p>

    <ul>
        <li><strong>Session Name:</strong> {{ ucfirst($slot->name) }}</li>
        <li><strong>Date:</strong> {{ $slot->date }}</li>
        <li><strong>Time:</strong> {{ $slot->start_time }} - {{ $slot->end_time }}</li>
        <li><strong>Agenda:</strong> {{ ucfirst($slot->sessionLeads->agenda ?? 'N/A') }}</li>
    </ul>

    <p>If this was a mistake, you can rebook anytime from your dashboard.</p>
</body>
</html>
