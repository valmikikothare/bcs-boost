<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f7f9; padding: 40px 0; margin: 0;">

    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background-color: #ffffff; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0,0,0,0.08); overflow: hidden;">
        
        <!-- Header -->
        <tr>
            <td style="background-color: #343a40; padding: 24px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">🎉 Welcome, {{ $data['name'] ?? 'User' }}!</h1>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding: 30px 40px; font-size: 16px; color: #333; line-height: 1.6;">
                <p>Hi <strong>{{ $data['name'] ?? 'there' }}</strong>,</p>

                <p>
                    Thanks for registering with us! Your account has been created successfully.  
                    Please verify your email to activate your account and start exploring everything we offer.
                </p>

                <!-- Account Details Box -->
                <div style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 16px; border-radius: 6px; margin: 20px 0;">
                    <strong>📌 Account Details</strong><br>
                    📧 <strong>Email:</strong> {{ $data['email'] ?? 'Not provided' }}
                </div>

                <!-- Verification Button -->
                <div style="text-align: center; margin: 25px 0;">
                    <a href="{{ $data['verification_link'] ?? '#' }}"
                        style="background-color: #2e7d32; color: #ffffff; padding: 14px 30px; text-decoration: none; border-radius: 6px; font-size: 16px; font-weight: bold; display: inline-block;">
                        ✅ Verify My Email
                    </a>
                </div>

                <!-- Fallback URL -->
                <p style="font-size: 14px; color: #555;">
                    If the button above doesn’t work, copy and paste this link into your browser:
                </p>
                <p style="word-break: break-all; font-size: 14px; color: #2563eb;">
                    <a href="{{ $data['verification_link'] ?? '#' }}" style="color: #2563eb;">
                        {{ $data['verification_link'] ?? '#' }}
                    </a>
                </p>

                <!-- Security Note -->
                <p style="font-size: 14px; color: #888; margin-top: 20px;">
                    ⚠️ If you didn’t create this account, you can safely ignore this email.
                </p>

                <p>
                    We’re excited to have you on board. Let’s make great things happen together! 🚀  
                    You can also visit the <a href="https://bcs-boost.mit.edu/" target="_blank" style="color:#2563eb;">Boost Website</a> for more details.
                </p>

                <p style="margin-top: 25px;">
                    Cheers,<br>
                    <strong>{{ config('app.name') }} Team</strong>
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f1f1f1; text-align: center; padding: 16px; font-size: 12px; color: #777;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
