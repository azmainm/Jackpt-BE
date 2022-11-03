<?php

namespace App\Interfaces;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function updateProduct($orderId, array $newDetails);
}
