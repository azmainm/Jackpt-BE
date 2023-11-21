<?php

namespace App\Mail;

use App\Domains\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $data)
    {
        $this->data = $data;
    }

    /**
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('no-reply@jackput.com', 'Jackpt'),
            subject: 'Verify Your Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $link = config('client.client_url').'verification?key='.$this->data->secret_key;

        return new Content(
            view: 'registerUserMail',
            with: [
                'userName' => $this->data->name,
                'link' => $link,
                'clientUrl' => config('client.client_url'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
