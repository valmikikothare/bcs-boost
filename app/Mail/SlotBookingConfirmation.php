<?php

namespace App\Mail;

use App\Models\Slot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlotBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $slot;
    public $user;

    public function __construct($user, $slot)
    {
        $this->user = $user;
        $this->slot = $slot;
    }

    public function build()
    {
        return $this->subject('Your Session Booking is Confirmed')
                    ->view('emails.slot_booking_confirmation');
    }
}
