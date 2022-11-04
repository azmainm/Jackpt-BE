<?php

namespace App\Services\Product;

use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProductService
{
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function index($id)
    {
        $products = $this->productRepositoryInterface->where('user_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'products' => ProductResource::collection($products),
        ]);
    }

    private function makeProductData($data, $id)
    {
        return [
            "title" => $data->title,
            "user_id" => $id,
            "price" => $data->price,
            "slug" => Str::slug($data->title),
            "discounted_price" => $data->discounted_price,
            "description" => $data->description,
            "variant" => $data->variant,
            "color" => $data->color,
            "product_image" => $data->product_image ? $this->storeProductImage($data->product_image) : null,
            "thumbnail_image" => $data->thumbnail_image ? $this->storeProductImage($data->thumbnail_image) : null,
            "short_image" => $data->short_image ? $this->storeProductImage($data->short_image) : null,
        ];


    }

    private function makeProductUpdateData($data)
    {
        $dataArray = [];
        if (isset($data->title)) $dataArray['title'] = $data->title;
        if (isset($data->user_id)) $dataArray['user_id'] = $data->user_id;
        if (isset($data->price)) $dataArray['price'] = $data->price;
        if (isset($data->discounted_price)) $dataArray['discounted_price'] = $data->discounted_price;
        if (isset($data->description)) $dataArray['description'] = $data->description;
        if (isset($data->variant)) $dataArray['variant'] = $data->variant;
        if (isset($data->color)) $dataArray['color'] = $data->color;
        if (isset($data->product_image)) $dataArray['product_image'] = $this->storeProductImage($data->product_image);
        if (isset($data->thumbnail_image)) $dataArray['thumbnail_image'] = $this->storeProductImage($data->thumbnail_image);
        if (isset($data->short_image)) $dataArray['short_image'] = $this->storeProductImage($data->short_image);
        return $dataArray;
    }

    private function storeProductImage($base64Image)
    {
        $slashIndex = strpos($base64Image, '/');
        $semicolonIndex = strpos($base64Image, ';');
        $extension = substr($base64Image, $slashIndex + 1, ($semicolonIndex - $slashIndex) - 1);
        $nameExt = time() . '.' . $extension;
        $name = public_path('product/') . $nameExt;
        Image::make($base64Image)->save($name);
        return $nameExt;
    }

    public function storeProduct($data, $id)
    {
        $data = $this->makeProductData($data, $id);
        $this->productRepositoryInterface->insert($data);
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function showProduct($slug, $id)
    {
        $product = $this->productRepositoryInterface->where('slug', $slug)->where('user_id', $id)->first();
        return response()->json([
            'status' => 'success',
            'product' => new ProductResource($product),
        ]);
    }

    public function deleteProduct($slug, $id)
    {
        $this->productRepositoryInterface->where('slug', $slug)->where('user_id', $id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function updateProduct($request, $slug, $id)
    {
        $product = $this->productRepositoryInterface->where('slug', $slug)->where('user_id', $id)->first();
        $this->productRepositoryInterface->updateProduct($product->id, $this->makeProductUpdateData($request));
        return response()->json([
            'status' => 'success',
        ]);
    }
}
