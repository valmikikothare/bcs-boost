<?php

namespace App\Console\Commands;

use App\Models\Slot;
use App\Models\User;
use App\Models\SessionLeads;
use App\Models\BookingHistory;
use App\Models\SessionEmailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class StoreReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:store-reminder-emails {--days-before=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store upcoming session reminder emails as jobs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Days before session
        $days_before = $this->option('days-before');

        if (is_null($days_before)) {
            $days_before = config('schedule.reminder_days_before');
        }

        // Send reminder emails days_before days prior to session
        $targetDate = Carbon::today()->addDays($days_before)->toDateString();

        $slots = Slot::where('date', $targetDate)->get();

        foreach ($slots as $slot) {
            // Lead user
            $lead = SessionLeads::where('slot_id', $slot->id)->first();
            if ($lead) {
                $leadUser = User::find($lead->user_id);
                if ($leadUser) {
                    SessionEmailJob::firstOrCreate([
                        'email' => $leadUser->email,
                        'type' => 0, // lead
                    ]);
                }
            }

            // All participant users
            $bookings = BookingHistory::where('slot_id', $slot->id)
                ->where('status', 1)
                ->get();

            foreach ($bookings as $booking) {
                $participantUser = User::find($booking->user_id);
                if ($participantUser) {
                    SessionEmailJob::firstOrCreate([
                        'email' => $participantUser->email,
                        'type' => 1, // participant
                    ]);
                }
            }
        }

        Log::info("Successfully stored session reminder email jobs.");
    }
}
