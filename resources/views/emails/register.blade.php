<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f7f9; padding: 30px 0; margin: 0;">

    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); overflow: hidden;">
        
        <!-- Header -->
        <tr>
            <td style="background-color: #343a40; padding: 24px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">🎉 Welcome Aboard!</h1>
            </td>
        </tr>
        
        <!-- Body -->
        <tr>
            <td style="padding: 30px 40px; color: #333333; font-size: 16px; line-height: 1.6;">
                <p>Hi <strong>{{ $data['name'] ?? 'there' }}</strong>,</p>

                <p>
                    We’re absolutely thrilled to have you join our community! 🚀  
                    Your registration was successful, and you’re now ready to explore all the features we offer.
                </p>

                <div style="background: #f9fafb; padding: 15px; border-radius: 6px; border: 1px solid #e5e7eb; margin: 20px 0;">
                    <strong>📌 Quick Account Details</strong><br><br>
                    📧 <strong>Email:</strong> {{ $data['email'] }}
                </div>

                <p>
                    If you have any questions or need assistance, our support team is always here to help you out.  
                    Don’t hesitate to reach out!
                </p>

                <p style="margin: 20px 0;">
                    You can also visit the  
                    <a href="https://bcs-boost.mit.edu/" target="_blank" style="color: #2563eb; font-weight: bold; text-decoration: none;">
                        Boost Website
                    </a>  
                    for more details and updates.
                </p>

                <p style="margin-top: 25px;">
                    Thank you again for joining us — let’s make great things happen together! 🌟
                </p>

                <p>
                    Best regards,<br>
                    <strong>{{ config('app.name') }} Team</strong>
                </p>
            </td>
        </tr>
        
        <!-- Footer -->
        <tr>
            <td style="background-color: #f1f1f1; text-align: center; padding: 16px; font-size: 13px; color: #777;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
