<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'image' => URL::asset($this->image),
            'product_name' => $this->product_name,
            'product_details' => $this->product_details,
            'category' => $this->category?json_decode($this->category):[],
            'type' => $this->type,
            'division' => $this->division,
            'district' => $this->district,
            'price' => $this->price,
            'area' => $this->area,
            'offers' => OfferResource::collection($this->offers),
        ];
    }
}
