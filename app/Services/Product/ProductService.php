<?php

namespace App\Services\Product;

use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function index()
    {
        $products =  $this->productRepositoryInterface->where('user_id', 1)->get();
        dd($products);
    }
}
