<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Session Reminder</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0">
        <!-- Header -->
        <tr>
            <td align="center" bgcolor="#2e7d32" style="padding: 20px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Session Reminder</h1>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td align="center" style="padding: 30px;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="font-size: 16px; color: #333; line-height: 1.6;">
                            <p>Dear <strong>{{ $name ?? 'Participant' }}</strong>,</p>

                            <p>
                                Thank you for registering for a <strong>BOOST session</strong>!  
                                This is a friendly reminder of your upcoming session details:
                            </p>

                            <!-- Session Details Table -->
                            <table cellpadding="10" cellspacing="0" width="100%" 
                                style="border-collapse: collapse; background: #fafafa; border-radius: 6px; margin: 20px 0;">
                                <tr>
                                    <td style="font-weight: bold; width: 40%;">Session Date & Time:</td>
                                    <td>{{ $sessionDateTime ?? 'Your scheduled time' }}</td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <div style="text-align: center; margin: 25px 0;">
                                <a href="https://bcs-boost.mit.edu/"
                                    style="background-color: #2e7d32; color: #ffffff; padding: 12px 28px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 15px; display: inline-block;">
                                    View Session Details
                                </a>
                            </div>

                            <p>
                                We look forward to your participation and an engaging session ahead!  
                                For updates or more information, please visit the 
                                <a href="https://bcs-boost.mit.edu/" target="_blank" style="color: #2563eb;">Boost website</a>.
                            </p>

                            <p style="margin-top: 25px;">
                                Thank you,<br>
                                <strong>{{ config('app.name') }} Team</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" bgcolor="#222" style="color: #bbb; padding: 15px; font-size: 12px;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>

</html>
