<?php

namespace App\Services\User;


use App\Interfaces\UserRepositoryInterface;


class AuthService
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function login($validator)
    {
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register($validator, $password)
    {
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = $this->userRepositoryInterface->create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    private function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
