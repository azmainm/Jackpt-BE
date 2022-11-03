<?php

namespace App\Repository;

use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function updateProduct($orderId, array $newDetails)
    {
        return Product::whereId($orderId)->update($newDetails);
    }
}
