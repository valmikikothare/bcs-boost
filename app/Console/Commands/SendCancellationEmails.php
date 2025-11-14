<?php

namespace App\Console\Commands;

use App\Models\CancellationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendCancellationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-cancellation-emails {--batch-size=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send up to batch-size cancellation emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Maximum number of emails to send in one go
        $batch_size = $this->option('batch-size');

        if (is_null($batch_size)) {
            $batch_size = config('schedule.email_batch_size');
        }

        // Fetch 10 unsent mails at a time
        $mails = CancellationMail::where('email_send_status', 0)->take($batch_size)->get();

        if ($mails->isEmpty()) {
            Log::info('No pending cancellation emails to send.');
        }

        foreach ($mails as $mail) {
            try {
                Mail::html($mail->mail_template, function ($message) use ($mail) {
                    $message->to($mail->email)->subject($mail->subject);
                });

                // Mark as sent
                $mail->email_send_status = 1;
                $mail->save();

                // Soft delete so further reminder emails can be sent to this user
                $mail->delete();

                // Log success if mail succeeds 
                Log::info("Successfully sent cancellation email to {$mail->email}.");
            } catch (\Exception $e) {
                Log::error("Failed to send cancellation email to {$mail->email}: " . $e->getMessage());
            }

            // Delay between emails sent
            /* sleep(1); */
        }
    }
}
