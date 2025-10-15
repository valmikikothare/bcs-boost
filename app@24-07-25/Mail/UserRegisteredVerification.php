<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegisteredVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // optional if you're passing dynamic data

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Welcome to Our Platform')
                    ->view('emails.register_verification')
                    ->with('data', $this->data);
    }
}
