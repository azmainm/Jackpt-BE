<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CapTableDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'total_percentage' => $this->total_percentage ?? null,
            'warrant_pool_percentage' => $this->warrant_pool_percentage ?? null,
            'number_of_warrant_pool' => $this->number_of_warrant_pool ?? null,
            'nominal_warrant_pool' => $this->nominal_warrant_pool ?? null,
            'remaining_percentage' => $this->remaining_percentage ?? null,
            'cap_table_type' => $this->cap_table_type ?? null,
            'is_published' => $this->is_published ?? null,
        ];
    }
}
