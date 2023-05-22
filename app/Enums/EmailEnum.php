<?php

namespace App\Enums;

enum EmailEnum: string
{
    case REGISTRATION = 'registration';
    case FORGOT_PASSWORD = 'forgot_password';
    case SUBSCRIBE = 'subscribe';
    case INVITATION = 'invitation';
    case PARTICIPANT = 'participant';
}
