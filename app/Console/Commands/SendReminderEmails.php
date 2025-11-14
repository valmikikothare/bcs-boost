<?php

namespace App\Console\Commands;

use App\Models\Slot;
use App\Models\User;
use App\Models\SessionLeads;
use App\Models\BookingHistory;
use App\Models\SessionEmailJob;
use App\Mail\LeadSessionReminder;
use App\Mail\ParticipantSessionReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder-emails {--batch-size=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send up to batch-size session reminder emails';

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

        // Get only batch_size unsent emails
        $jobs = SessionEmailJob::where('status', 0)->limit($batch_size)->get();

        if ($jobs->isEmpty()) {
            Log::info('No pending session reminder emails to send.');
        }

        foreach ($jobs as $job) {
            // Skip if email is invalid
            if (!filter_var($job->email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            // Get user by email
            $user = User::where('email', $job->email)->first();
            $name = $user?->name ?? 'User';

            // Default session datetime
            $sessionDateTime = 'Scheduled Date/Time';

            // Try to get slot from session lead
            $leadRecord = SessionLeads::where('user_id', $user->id ?? 0)->first();
            if ($leadRecord) {
                $slot = Slot::find($leadRecord->slot_id);
                if ($slot) {
                    $sessionDateTime = $slot->date . ' ' . $slot->time;
                }
            } else {
                // Try from booking history
                $booking = BookingHistory::where('user_id', $user->id ?? 0)->first();
                if ($booking) {
                    $slot = Slot::find($booking->slot_id);
                    if ($slot) {
                        $sessionDateTime = $slot->date . ' ' . $slot->time;
                    }
                }
            }

            // Send email based on type
            try {
                if ($job->type == 0) {
                    // Lead email
                    Mail::to($job->email)->send(new LeadSessionReminder($name, $sessionDateTime));
                } elseif ($job->type == 1) {
                    // Participant email
                    Mail::to($job->email)->send(new ParticipantSessionReminder($name, $sessionDateTime));
                }

                // Update status after sending
                $job->status = 1;
                $job->save();

                // Soft delete so further reminder emails can be sent to this user
                $job->delete();

                // Log success if mail succeeds 
                Log::info("Successfully sent session reminder email to {$job->email}.");
            } catch (\Exception $e) {
                // Log error if mail fails
                Log::error("Failed to send email to {$job->email}: " . $e->getMessage());
            }

            // Delay between emails sent
            /* sleep(1); */
        }
    }
}
