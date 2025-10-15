<!DOCTYPE html>
<html>
<head>
    <title>Session Reminder</title>
</head>
<body>
    <p>Dear {{ $name ?? 'Leader' }},</p>

    <p>Thank you for volunteering to lead a BOOST session!</p>

    <p>This is a reminder that your session is scheduled for <strong>{{ $sessionDateTime ?? 'your scheduled time' }}</strong>.</p>

    <p>Please also be sure to post a brief description of your talk on the BOOST Slack channel to help generate interest and engagement.</p>

    <p>Looking forward to your session!</p>

    <p>Warm regards,<br>
    The BOOST Team</p>
</body>
</html>
