<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $userMessage
    ) {
    }

    public function build(): self
    {
        // Keep SPF/DMARC-safe sender from app config, user address goes to Reply-To.
        return $this->from((string) config('mail.from.address'), (string) config('mail.from.name'))
            ->replyTo($this->email, $this->name)
            ->subject('New contact message from rozliczPWS.pl')
            ->view('contact_email')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'user_message' => $this->userMessage,
            ]);
    }
}
