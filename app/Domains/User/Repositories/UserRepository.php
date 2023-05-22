<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Models\User;
use App\Infrastructure\Eloquent\Repository;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    public function filter()
    {
        return $this->model->where();
    }

    public function checkUserExist(string $email): User|null
    {
        return $this->model->where('email', $email)->first();
    }

    public function checkStatus($email): User|null
    {
        return $this->model->where('email', $email)->first(['status']);
    }

    public function checkUserExistByKey(string $key): User|null
    {
        return $this->model->where('secret_key', $key)->first(['id', 'secret_key', 'status']);
    }
}
