<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SessionLeadRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $slot;
    public $agenda;
    public $description;
    public $otherDetails;

    public function __construct($user, $slot, $agenda, $description, $otherDetails)
    {
        $this->user = $user;
        $this->slot = $slot;
        $this->agenda = $agenda;
        $this->description = $description;
        $this->otherDetails = $otherDetails;
    }

    public function build()
    {
        return $this
            ->subject('New Session Lead Request')
            ->view('emails.session_lead_request');
    }
}
