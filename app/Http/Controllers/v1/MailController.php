<?php

namespace App\Http\Controllers\v1;

use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\UserRegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __construct()
    {
    }

    public function sendRegisterMail(Request $request)
    {
        //        \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
        $user = User::find(1);
        Mail::to('rahman@tikweb.com')->send(new UserRegistrationMail($user));

        return $this->success();
    }
}
