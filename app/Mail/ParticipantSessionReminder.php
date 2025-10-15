<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantSessionReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $sessionDateTime;

    public function __construct($name, $sessionDateTime)
    {
        $this->name = $name;
        $this->sessionDateTime = $sessionDateTime;
    }

    public function build()
    {
        return $this->subject('Reminder: Your Upcoming BOOST Session')
                    ->view('emails.participant_reminder')
                    ->with([
                        'name' => $this->name,
                        'sessionDateTime' => $this->sessionDateTime,
                    ]);
    }
}