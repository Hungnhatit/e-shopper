<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $data = [
        'username',
        'address',
        'product'
    ];
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    // Hàm này sẽ hiển thị tiêu đề của email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email xác nhận đơn hàng',
        );
    }

    /**
     * Get the message content definition.
     */
    // Hàm này sẽ là nội dụng (content) của email
    public function content(): Content
    {
        return new Content(
            view: 'frontend.mail.content',
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
