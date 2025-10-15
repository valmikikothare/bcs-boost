<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <!-- Header -->
        <tr>
            <td align="center" bgcolor="#222" style="padding: 20px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Booking Confirmed</h1>
            </td>
        </tr>

        <!-- Main Content -->
        <tr>
            <td align="center" style="padding: 30px;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <tr>
                        <td>
                            <p style="font-size: 16px; margin: 0 0 10px 0;">Hello
                                <strong>{{ ucfirst($user->name) }}</strong>,</p>
                            <p style="font-size: 16px; margin: 0 0 20px 0;">
                                We’re excited to let you know that your booking has been
                                <span style="color: green; font-weight: bold;">confirmed</span>!
                            </p>

                            <!-- Session Details Table -->
                            <table cellpadding="10" cellspacing="0" width="100%"
                                style="border-collapse: collapse; background: #fafafa; border-radius: 6px;">
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold; width: 40%;">Session
                                        Name:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ ucfirst($slot->name) }}</td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold;">Date:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ $slot->date }}</td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold;">Time:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ $slot->start_time }} –
                                        {{ $slot->end_time }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Short Description:</td>
                                    <td>{{ optional($slot->sessionLeads->first())->agenda ?? 'N/A' }}</td>
                                </tr>
                            </table>

                            <!-- Call to Action -->
                            <p style="font-size: 16px; margin: 25px 0 10px 0;">
                                We look forward to seeing you at the session!
                            </p>
                            <p style="font-size: 14px; color: #555; margin: 0 0 20px 0;">
                                If you have any questions, please reach out to our support team.
                            </p>

                            <div style="text-align: center; margin: 20px 0;">
                                <a href="https://bcs-boost.mit.edu/" target="_blank"
                                    style="background: #28a745; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px; display: inline-block;">
                                    Visit Boost Website
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" bgcolor="#222" style="color: #bbb; padding: 15px; font-size: 12px;">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </td>
        </tr>
    </table>
</body>

</html>
