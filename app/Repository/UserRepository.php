<?php

namespace App\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;


abstract class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
