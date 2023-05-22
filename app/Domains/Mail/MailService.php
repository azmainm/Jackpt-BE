<?php

namespace App\Domains\Mail;

use App\Domains\User\Models\User;
use App\Enums\EmailEnum;
use App\Jobs\SendPasswordReset;
use App\Jobs\SendUserEmail;
use App\Models\Event;

class MailService
{
    public User $user;

    public EmailEnum $mailType;

    public array $participants;

    public Event $event;

    public function __construct()
    {
    }

    public function setUser(User $user): MailService
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return $this
     */
    public function setMailType(EmailEnum $mailType): MailService
    {
        $this->mailType = $mailType;

        return $this;
    }

    public function setEvent(Event $event): MailService
    {
        $this->event = $event;

        return $this;
    }

    public function setParticipants(array $participants): MailService
    {
        $this->participants = $participants;

        return $this;
    }

    public function sendEmail(): void
    {
        if ($this->mailType == EmailEnum::REGISTRATION) {
            dispatch(new SendUserEmail($this->user));
        }
        if ($this->mailType == EmailEnum::FORGOT_PASSWORD) {
            dispatch(new SendPasswordReset($this->user));
        }
    }
}
