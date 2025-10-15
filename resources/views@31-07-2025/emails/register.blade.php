<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 40px 0;">

    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <tr>
            <td style="background-color: #4CAF50; padding: 20px 40px;">
                <h1 style="color: #ffffff; margin: 0;">🎉 Welcome Aboard!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px 40px;">
                <p style="font-size: 16px; color: #333333;">Hi there,</p>

                <p style="font-size: 16px; color: #333333;">
                    We're thrilled to have you join our community! Your registration was successful, and you're now ready to explore all the amazing features we offer.
                </p>

                <p style="font-size: 16px; color: #333333;">
                    <strong>Here's a quick summary:</strong><br>
                    <span style="display: block; margin-top: 10px;">
                        📧 <strong>Email:</strong> {{ $data['email'] }}<br>
                    </span>
                </p>

                <p style="font-size: 16px; color: #333333;">
                    If you have any questions or need assistance, our support team is always here to help.
                </p>

                <p style="font-size: 16px; color: #333333;">
                    Thanks again for joining us — let's make great things happen together! 🚀
                </p>

                <p style="font-size: 16px; color: #333333;">
                    Cheers,<br>
                    The Team at {{ config('app.name') }}
                </p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f1f1f1; text-align: center; padding: 20px; font-size: 12px; color: #777;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
