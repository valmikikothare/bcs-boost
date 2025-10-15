<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Session Lead Request</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <!-- Header -->
        <tr>
            <td align="center" bgcolor="#343a40" style="padding: 20px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">New Session Lead Request</h1>
            </td>
        </tr>

        <!-- Main Content -->
        <tr>
            <td align="center" style="padding: 30px;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <tr>
                        <td>
                            <p style="font-size: 16px; margin: 0 0 10px 0;">Hello,</p>
                            <p style="font-size: 16px; margin: 0 0 20px 0;">
                                A user has submitted a request to <strong>lead a session</strong>. Here are the details:
                            </p>

                            <!-- Session Details Table -->
                            <table cellpadding="10" cellspacing="0" width="100%" 
                                style="border-collapse: collapse; background: #fafafa; border-radius: 6px;">
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold; width: 40%;">User:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ $user->name }} ({{ $user->email }})</td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold;">Requested Slot:</td>
                                    <td style="border-bottom: 1px solid #ddd;">
                                        {{ $slot->name }}<br>
                                        Date: {{ \Carbon\Carbon::createFromFormat('m-d-Y', $slot->date)->format('F j, Y') }}<br>
                                        Time: {{ $slot->start_time }} – {{ $slot->end_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold;">Short Description:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ $agenda }}</td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; font-weight: bold;">Full Description:</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{ $description }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Background Knowledge Expected:</td>
                                    <td>{{ $otherDetails ?? 'N/A' }}</td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #555; margin: 20px 0;">
                                For more details, visit the 
                                <a href="https://bcs-boost.mit.edu/" target="_blank">Boost website</a>.
                            </p>

                            <p style="font-size: 16px; margin: 0;">
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
