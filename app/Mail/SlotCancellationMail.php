<?php

namespace App\Mail;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlotCancellationMail extends Mailable
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
        return $this->subject('Slot Cancellation Notice')
                    ->view('emails.slot_cancellation')
                    ->with([
                        'user' => $this->user,
                        'slot' => $this->slot,
                    ]);
    }
}
