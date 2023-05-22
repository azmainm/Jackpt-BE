<?php

namespace App\Http\Controllers\v1;

use App\Domains\User\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserExistController extends Controller
{
    public function checkUserExist(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = (new UserRepository())->checkUserExist($request->input('email'));
        if (! $user) {
            return $this->success('NO', data: ['message' => 'NO']);
        }

        return $this->success('YES', data: ['message' => 'YES']);
    }
}
