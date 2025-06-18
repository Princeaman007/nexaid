<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Application $application,
        public string $customMessage = ''
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Candidature acceptée - ' . $this->application->internship->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-accepted',
        );
    }
}