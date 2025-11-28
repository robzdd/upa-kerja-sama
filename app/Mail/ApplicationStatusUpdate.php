<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $jobTitle;
    public $status;
    public $statusLabel;
    public $emailSubject;
    public $emailMessage;
    public $companyName;

    /**
     * Create a new message instance.
     */
    public function __construct($applicantName, $jobTitle, $status, $statusLabel, $subject, $message, $companyName)
    {
        $this->applicantName = $applicantName;
        $this->jobTitle = $jobTitle;
        $this->status = $status;
        $this->statusLabel = $statusLabel;
        $this->emailSubject = $subject;
        $this->emailMessage = $message;
        $this->companyName = $companyName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.application-status',
            with: [
                'applicantName' => $this->applicantName,
                'jobTitle' => $this->jobTitle,
                'status' => $this->status,
                'statusLabel' => $this->statusLabel,
                'emailSubject' => $this->emailSubject,
                'emailMessage' => $this->emailMessage,
                'companyName' => $this->companyName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

