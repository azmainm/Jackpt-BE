<?php

namespace App\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class ProductRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
