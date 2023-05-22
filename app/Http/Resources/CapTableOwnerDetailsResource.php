<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CapTableOwnerDetailsResource extends JsonResource
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
            'name' => $this->name ?? null,
            'company_name' => $this->company_name ?? null,
            'role' => $this->role ?? null,
            'is_owner' => $this->is_owner ?? null,
            'cash_investment' => $this->cash_investment ?? null,
            'asset_investment' => $this->asset_investment ?? null,
            'working_time' => $this->working_time ?? null,
            'ownership_percentage' => $this->ownership_percentage ?? null,
        ];
    }
}
