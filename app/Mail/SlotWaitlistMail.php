<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Slot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlotWaitlistMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $slot;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Slot $slot)
    {
        $this->user = $user;
        $this->slot = $slot;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('You are Waitlisted for a Session')
                    ->markdown('emails.waitlist');
    }
}
