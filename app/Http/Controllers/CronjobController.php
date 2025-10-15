<?php
namespace App\Http\Controllers;

use App\Models\CancellationMail;
use Illuminate\Support\Facades\Mail;

class CronjobController extends Controller
{
    public function sendCancellationMails()
    {
        // Fetch 10 unsent mails at a time
        $mails = CancellationMail::where('email_send_status', 0)
            ->take(10)
            ->get();

        if ($mails->isEmpty()) {
            return back()->with('info', 'No pending emails to send.');
        }

        foreach ($mails as $mail) {
            try {
                Mail::html($mail->mail_template, function ($message) use ($mail) {
                    $message->to($mail->email)
                        ->subject($mail->subject);
                });

                // Mark as sent
                $mail->update(['email_send_status' => 1]);

            } catch (\Exception $e) {
                \Log::error("Failed to send cancellation mail to {$mail->email}: " . $e->getMessage());
            }
        }

        return back()->with('success', '10 Emails have been successfully sent. Run again to send the next batch.');
    }
}
