<!DOCTYPE html>
<html>
<head>
    <title>Session Reminder</title>
</head>
<body>
    <p>Dear {{ $name ?? 'Participant' }},</p>

    <p>Thank you for registering to participate in a BOOST session!</p>

    <p>This is a friendly reminder that your session is scheduled for <strong>{{ $sessionDateTime ?? 'your scheduled time' }}</strong>.</p>

    <p>Looking forward to your participation!</p>

    <p>Warm regards,<br>
    The BOOST Team</p>
</body>
</html>
