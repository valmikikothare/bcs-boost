<?php
namespace App\Mail;

use App\Models\SessionLeads;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;

    /**
     * Create a new message instance.
     */
    public function __construct(SessionLeads $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject(subject: 'Your Lead Request Has Been Approved')
            ->view('emails.lead_approved');
    }
}
