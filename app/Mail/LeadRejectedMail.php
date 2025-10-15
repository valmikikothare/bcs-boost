<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;

    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    public function build()
    {
        return $this->subject('Session Lead Application Rejected')
            ->view('emails.rejected')
            ->with([
                'lead' => $this->lead,
            ]);
    }
}
