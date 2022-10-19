<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected string $filename)
    {
        //
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'As combinações de cerveja que você pediu!',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.export',
            with: [
                'filename' => $this->filename
            ]
        );
    }

    public function attachments()
    {
        return [
            Attachment::fromStorage($this->filename)
        ];
    }
}
