<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Session Cancelled</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px;">
        <h2 style="color: #e3342f;">Session Cancelled</h2>
        <p>Hello {{ $user->name ?? 'User' }},</p>

        <p>We would like to inform you that your scheduled session has been <strong>cancelled</strong>.</p>

        <h3 style="margin-top:20px; color:#333;">Session Details</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Session:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $slot->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Date:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $slot->date ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Time:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $slot->start_time ?? 'N/A' }} - {{ $slot->end_time ?? 'N/A' }}
                </td>
            </tr>
        </table>

        <p style="margin-top: 20px;">You can book another session anytime on our platform.</p>
        <p style="font-size: 14px; color: #555; margin: 20px 0;">
            <a href="https://bcs-boost.mit.edu/" target="_blank">https://bcs-boost.mit.edu/</a>
        </p>
        <br>
        <p>Thank you,<br>Support Team</p>
    </div>
</body>

</html>
