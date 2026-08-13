<?php

namespace App\Mail;

use App\Models\PpidKeberatan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PpidKeberatanMail extends Mailable
{
    use Queueable, SerializesModels;

    public PpidKeberatan $keberatan;

    public ?string $fromEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(PpidKeberatan $keberatan, ?string $fromEmail = null)
    {
        $this->keberatan = $keberatan;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusStr = ucwords($this->keberatan->status);
        $token = $this->keberatan->token;

        $envelope = new Envelope(
            subject: "Tanggapan Keberatan PPID [{$token}] - {$statusStr}",
        );

        if ($this->fromEmail) {
            $envelope->from = new Address(
                $this->fromEmail,
                'PPID Dinas Kesehatan Kabupaten Cianjur'
            );
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $settingFooter = \App\Models\SettingFooter::first();

        return new Content(
            view: 'emails.ppid-keberatan-tanggapan',
            with: [
                'settingFooter' => $settingFooter,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
