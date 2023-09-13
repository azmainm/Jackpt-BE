<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Jobs\MailJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class SendMailController extends Controller
{
    public function sendMail(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users'
        ]);
        if($validator->fails()){
            return new JsonResponse([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }
        $email = $request->all()['email'];

//        $sendMail = SendMail::create([
//            'email' => $email
//        ]);
      //  $sendMail = 1;
        dispatch(new MailJob($email));
        return new JsonResponse(
            [
                'success' => true,
                'message' => "Thank you for subscribing to our email, please check your inbox"
            ],
            200
        );
    }
}
