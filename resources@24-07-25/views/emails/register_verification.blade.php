<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 40px 0;">

    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <!-- Header -->
        <tr>
            <td style="background-color: #4CAF50; padding: 20px 40px;">
                <h1 style="color: #ffffff; margin: 0;">🎉 Welcome Aboard, {{ $data['name'] ?? 'User' }}!</h1>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 30px 40px;">
                <p style="font-size: 16px; color: #333;">Hi {{ $data['name'] ?? 'there' }},</p>

                <p style="font-size: 16px; color: #333;">
                    Thank you for registering with us! Your account has been created successfully. You're just one step away from accessing everything our platform has to offer.
                </p>

                <p style="font-size: 16px; color: #333;">
                    <strong>Account Details:</strong><br>
                    📧 <strong>Email:</strong> {{ $data['email'] ?? 'Not provided' }}
                </p>

                <p style="font-size: 16px; color: #333;">
                    Please verify your email by clicking the button below:
                </p>

                <!-- Verification Button -->
                <div style="text-align: center; margin: 20px 0;">
                    <a href="{{ $data['verification_link'] ?? '#' }}"
                       style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;">
                        ✅ Verify your email
                    </a>
                </div>

                <!-- Fallback URL -->
                <p style="font-size: 14px; color: #555;">
                    If the button doesn't work, copy and paste the link below into your browser:
                </p>
                <p style="word-break: break-all; font-size: 14px; color: #555;">
                    <a href="{{ $data['verification_link'] ?? '#' }}">{{ $data['verification_link'] ?? '#' }}</a>
                </p>

                <p style="font-size: 16px; color: #333;">
                    If you need any help, feel free to contact our support team anytime.
                </p>

                <p style="font-size: 16px; color: #333;">
                    We're excited to have you onboard. Let’s make great things happen together! 🚀
                </p>

                <p style="font-size: 16px; color: #333;">
                    Cheers,<br>
                    The Team at {{ config('app.name') }}
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f1f1f1; text-align: center; padding: 20px; font-size: 12px; color: #777;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
