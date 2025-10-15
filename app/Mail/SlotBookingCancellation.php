<?php

namespace App\Mail;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlotBookingCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $slot;

    public function __construct(User $user, Slot $slot)
    {
        $this->user = $user;
        $this->slot = $slot;
    }

    public function build()
    {
        return $this->subject('Your Booking Has Been Cancelled')
                    ->view('emails.slot_booking_cancellation');
    }
}