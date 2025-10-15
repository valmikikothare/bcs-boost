<?php
namespace App\Mail;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantCancellationMail extends Mailable
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
        return $this->subject('Booking Cancellation Notice')
            ->markdown('emails.cancellations.participant');
    }
}
