<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CapTableCompanyInformationResource extends JsonResource
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
            'id' => $this->uuid ?? null,
            'name' => $this->name ?? null,
            'country_id' => $this->country_id ?? null,
            'share_capital' => $this->share_capital ?? null,
            'share_value' => $this->share_value ?? null,
            'total_share' => $this->total_share ?? null,
            'incorporation_date' => $this->incorporation_date ?? null,
            'equity_type' => $this->equity_type ?? null,
            'total_number_of_warrant' => $this->equity_type ?? null,
            'total_nominal_warrant' => $this->equity_type ?? null,
            'total_number_of_share' => $this->equity_type ?? null,
            'total_nominal_share' => $this->equity_type ?? null,
        ];
    }
}
