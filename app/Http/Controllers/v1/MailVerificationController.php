<?php

namespace App\Http\Controllers\v1;

use App\Domains\User\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MailVerificationController extends Controller
{
    public function __construct(protected UserRepository $user)
    {
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string',
        ]);
        $user = $this->user->checkUserExistByKey(key: $request->input('key'));
        if (! $user) {
            return $this->success('NO');
        }
        if ($user['status'] == 'pending') {
            $this->user->update([
                'status' => 'active',
                'email_verified_at' => now(),
            ], $user->id);
        }

        return $this->success('YES');
    }
}
