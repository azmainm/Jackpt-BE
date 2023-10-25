<?php

namespace App\Http\Controllers\v1;

use App\Constants\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Domains\User\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function forgotPassword(Request $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->email)->first();

            if($user){
                $token = $user->secret_key;
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Password Reset";
                $data['body'] = "Click on the link to reset your password.";

                Mail::send('forgotPasswordMail', ['data'=>$data],function ($message) use ($data){

                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');

                $email = PasswordReset::where('email', $request->email)->get();

                if(is_null($email)){
                    PasswordReset::create([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime]);
                }else{
                    PasswordReset::where('email', $request->email)->update([
                        'token' => $token,
                        'created_at' => $datetime]);
                }

                return $this->success( "The link to reset your password is sent to your email.");
            }
            else{
                return $this->error(ResponseMessages::NOT_FOUND, 404);
            }
        }catch (\Exception $e){
                return $this->error(ResponseMessages::NOT_FOUND, 404);
            }

    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'secret_key' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $userUpdated = User::where('secret_key', $request->secret_key)
            ->update(['password' => Hash::make($request->password)]);

        if ($userUpdated) {
            return $this->success(data: ['message' => 'Password is updated', 'status' => 200, 'success' => true]);
        } else {
            return $this->error(message: ResponseMessages::NOT_FOUND, statusCode: 404);
        }

    }
}
