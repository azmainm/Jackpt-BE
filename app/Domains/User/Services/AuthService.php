<?php

namespace App\Domains\User\Services;

use App\Domains\Mail\MailService;
use App\Domains\User\Models\User;
use App\Domains\User\Repositories\UserRepository;
use App\Enums\EmailEnum;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class AuthService
{
    public function __construct(
        protected UserRepository $user,
        protected MailService $mailService
    ) {
    }

    public function login($loginData): array
    {
        $token = auth()->attempt($loginData);

        if (! $token) {
            return ['error' => 'User name or password not match!'];
        }

        return $this->createNewToken($token);
    }

    public function register($userData, $password): User
    {
        $user = $this->user->create(array_merge(
            $userData,
            ['password' => bcrypt($password)]
        ));
        $this->mailService->setMailType(EmailEnum::REGISTRATION)
            ->setUser($user)
            ->sendEmail();

        return $user;
    }

    /**
     * @return JsonResponse
     */
    public function createNewToken($token): array
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 6000,
            'user' => new UserResource(auth()->user()),
        ];
    }

    public function checkUserExist(string $email): mixed
    {
        return $this->user->checkUserExist($email);
    }
}
