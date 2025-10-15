<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTitle extends Mailable
{
    use Queueable, SerializesModels;
    
    public $data; // Add a public variable to hold the data array

    public function __construct($data)
    {
        $this->data = $data; // Store the data array in the class variable
    }
    
    public function build()
    {
        return $this->view('mail_templates.email_template')
            ->subject('Welcome to Our Application')
            ->with('data', $this->data); // Pass the data array to the email template
    }
}

