<?php

namespace App\Mail;

use App\Models\PpidPermohonan;
use App\Models\SettingFooter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PpidTanggapanMail extends Mailable
{
    use Queueable, SerializesModels;

    public PpidPermohonan $permohonan;

    public ?string $fromEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(PpidPermohonan $permohonan, ?string $fromEmail = null)
    {
        $this->permohonan = $permohonan;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusStr = ucwords($this->permohonan->status);
        $noPermohonan = $this->permohonan->token;

        $envelope = new Envelope(
            subject: "Tanggapan Permohonan Informasi PPID [{$noPermohonan}] - {$statusStr}",
        );

        if ($this->fromEmail) {
            $envelope->from = new Address(
                $this->fromEmail,
                'PPID Dinas Kesehatan Kabupaten Cianjur',
            );
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $settingFooter = SettingFooter::first();

        return new Content(
            view: 'emails.ppid-tanggapan',
            with: [
                'settingFooter' => $settingFooter,
                'senderEmail' => $this->fromEmail,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->permohonan->file_tanggapan && Storage::disk('public')->exists($this->permohonan->file_tanggapan)) {
            $path = Storage::disk('public')->path($this->permohonan->file_tanggapan);
            $attachments[] = Attachment::fromPath($path)
                ->as(basename($this->permohonan->file_tanggapan));
        }

        return $attachments;
    }
}
