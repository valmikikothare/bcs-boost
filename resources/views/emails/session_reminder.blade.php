<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Session Reminder</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <!-- Header -->
        <tr>
            <td align="center" bgcolor="#1f2937" style="padding: 20px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Session Reminder</h1>
            </td>
        </tr>

        <!-- Main Content -->
        <tr>
            <td align="center" style="padding: 30px;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <tr>
                        <td>
                            <p style="font-size: 16px; margin: 0 0 10px 0;">Hi <strong>{{ ucfirst($user->name) }}</strong>,</p>

                            <p style="font-size: 16px; margin: 0 0 20px 0;">
                                This is a friendly reminder about your upcoming session happening in <strong>2 days</strong>.
                            </p>

                            <!-- Session Details Table -->
                            <table cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; background: #fafafa; border-radius: 6px;">
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold; width: 40%;">Topic:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ $session->title }}</td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold;">Date:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ \Carbon\Carbon::parse($session->date)->format('F j, Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Time:</td>
                                    <td>{{ $session->start_time }} – {{ $session->end_time }}</td>
                                </tr>
                            </table>

                            <!-- Call to Action -->
                            <p style="font-size: 16px; margin: 25px 0 10px 0;">
                                We look forward to your active participation and engagement during the session.
                            </p>

                            <div style="text-align: center; margin: 20px 0;">
                                <a href="{{ $session->link ?? '#' }}" target="_blank"
                                    style="background: #343a40; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px; display: inline-block;">
                                    Join Session
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
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>
</body>

</html>
