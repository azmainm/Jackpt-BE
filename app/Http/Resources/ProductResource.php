<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title ?? null,
            "user_id" => $this->user_id ?? null,
            "price" => $this->price ?? null,
            "slug" => $this->slug ?? null,
            "discounted_price" => $this->discounted_price ?? null,
            "description" => $this->description ?? null,
            "variant" => json_decode($this->variant) ?? null,
            "color" => json_decode($this->color) ?? null,
            "product_image" => $this->product_image ?? null,
            "thumbnail_image" => $this->thumbnail_image ?? null,
            "short_image" => $this->short_image ?? null,
        ];
    }
}
