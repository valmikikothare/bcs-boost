<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>New Session Lead Request</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; margin:0; padding:0; color:#333;">

  <div style="max-width:650px; margin:auto; background:#fff; border-radius:8px; box-shadow:0px 4px 10px rgba(0,0,0,0.08); overflow:hidden;">

    <!-- Header -->
    <div style="background:#1a1a1a; color:#fff; padding:20px; text-align:center; font-size:20px; font-weight:bold;">
      New Session Lead Request
    </div>

    <!-- Body -->
    <div style="padding:25px; font-size:15px; line-height:1.6;">
      <p>Hello Admin,</p>
      <p>A new request has been submitted by a user to <strong>lead a session</strong>. Below are the details:</p>

      <p style="font-weight:bold; margin:18px 0 6px; color:#222;">User</p>
      <div style="background:#f9f9f9; padding:12px; border-radius:6px; border:1px solid #e5e7eb; font-size:14px; color:#444;">
        {{ $user->name }} <br>
        {{ $user->email }}
      </div>

      <p style="font-weight:bold; margin:18px 0 6px; color:#222;">Requested Slot</p>
      <div style="background:#f9f9f9; padding:12px; border-radius:6px; border:1px solid #e5e7eb; font-size:14px; color:#444;">
        <p><strong>{{ $slot->name }}</strong></p>
        <p>Date: {{ \Carbon\Carbon::createFromFormat('m-d-Y', $slot->date)->format('F j, Y') }}</p>
        <p>Time: {{ $slot->start_time }} - {{ $slot->end_time }}</p>
      </div>

      <p style="font-weight:bold; margin:18px 0 6px; color:#222;">Short Description</p>
      <div style="background:#f9f9f9; padding:12px; border-radius:6px; border:1px solid #e5e7eb; font-size:14px; color:#444;">
        {{ $agenda }}
      </div>

      <p style="font-weight:bold; margin:18px 0 6px; color:#222;">Detailed Description</p>
      <div style="background:#f9f9f9; padding:12px; border-radius:6px; border:1px solid #e5e7eb; font-size:14px; color:#444;">
        {{ $description }}
      </div>

      <p style="font-weight:bold; margin:18px 0 6px; color:#222;">Background Knowledge Expected</p>
      <div style="background:#f9f9f9; padding:12px; border-radius:6px; border:1px solid #e5e7eb; font-size:14px; color:#444;">
        {{ $otherDetails ?? 'N/A' }}
      </div>

      <!-- Button -->
      <div style="text-align:center; margin:25px 0;">
        <a href="https://bcs-boost.mit.edu/" target="_blank"
          style="background:#2563eb; color:#fff; padding:12px 28px; text-decoration:none; border-radius:6px; font-weight:bold; font-size:14px; display:inline-block;">
          Visit Boost Website
        </a>
      </div>

      <p>Thank you,<br><strong>{{ config('app.name') }}</strong></p>
    </div>

    <!-- Footer -->
    <div style="background:#f4f6f8; text-align:center; padding:15px; font-size:12px; color:#777; border-top:1px solid #e5e7eb;">
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>

  </div>

</body>
</html>
