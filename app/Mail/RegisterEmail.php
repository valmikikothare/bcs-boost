<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
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
                    ->view('emails.register')
                    ->with('data', $this->data);
    }
}
