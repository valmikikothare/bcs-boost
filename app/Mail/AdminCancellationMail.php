<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Slot;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $slot;
    public $requestedUser;

    /**
     * Create a new message instance.
     */
    public function __construct(User $admin, Slot $slot, User $requestedUser)
    {
        $this->admin = $admin;
        $this->slot = $slot;
        $this->requestedUser = $requestedUser;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Cancellation Request')
            ->markdown('emails.cancellationadminemail');
    }
}
