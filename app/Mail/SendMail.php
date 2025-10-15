<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $mailData)
    {
        // dd($mailData);die;
        $this->mailData =$mailData;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     $subjectWithPrefix = 'Subject: ' . $this->mailData['title'];
        
    //     return new Envelope([
    //         'subject' => $subjectWithPrefix, // Set subject with title and prefix
    //     ]);
    // }
    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'admin.newsletter.newsletter_listing',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    // public function build()
    // {
    //     return $this->subject('Welcome to My Website')
    //     ->view('mail_templates.user_template')->with(['data'=>$this->mailData]);
    // }
    public function build()
{
    $subjectWithPrefix = 'Subject: ' . $this->mailData['title'];

    return $this->subject($subjectWithPrefix)
                ->view('mail_templates.user_template')
                ->with(['data' => $this->mailData]);
}
}
