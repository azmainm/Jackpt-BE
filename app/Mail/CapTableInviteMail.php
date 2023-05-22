<?php

namespace App\Mail;

use App\Domains\Invitation\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CapTableInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private Invitation $invitation, private $ownerId, private $capTableId)
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('no-reply@vutal.com', 'Vutal'),
            subject: 'Join Your CapTable',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $link = config('client.client_url').'/invitation?key='.
            $this->invitation->secret_key.'&owner_id='.
            $this->ownerId.'&cap_table_id='.$this->capTableId.'&email='.$this->invitation->email;

        return new Content(
            view: 'capTableInviteMail',
            with: [
                'userName' => 'User',
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
