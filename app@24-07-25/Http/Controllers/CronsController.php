<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\User;
use Carbon\Carbon;
use App\Models\SessionLeads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\SessionReminderMail;
use App\Models\SessionEmailJob;
use App\Mail\LeadSessionReminder;
use App\Mail\ParticipantSessionReminder;
use App\Mail\SlotBookingConfirmation;
use App\Mail\SlotBookingCancellation;

class CronsController extends Controller
{
    public function storeUpcomingSessionEmailsToJobs()
    {
        $targetDate = Carbon::today()->addDays(2)->toDateString();

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

        return response()->json(['message' => 'Emails inserted successfully.']);
    }


    public function sendSessionReminderEmails()
    {
        // Get only 10 unsent emails
        $jobs = SessionEmailJob::where('status', 0)->limit(10)->get();

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
                    sleep(3); // Delay for participant emails
                }

                // Update status after sending
                $job->status = 1;
                $job->save();
            } catch (\Exception $e) {
                // Log error if mail fails
                \Log::error("Failed to send email to {$job->email}: " . $e->getMessage());
            }
        }

        return response()->json(['message' => 'Up to 10 reminder emails processed.']);
    }


    public function run_every_5min()
    {
        return $this->sendSessionReminderEmails();
    }

    public function run_every_day()
    {
        return $this->storeUpcomingSessionEmailsToJobs();
    }

}
