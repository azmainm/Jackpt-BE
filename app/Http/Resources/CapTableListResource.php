<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CapTableListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->uuid ?? null,
            'name' => $this->companyInformation->name ?? null,
            'share_capital' => $this->companyInformation->share_capital ?? null,
            'equity_types' => $this->companyInformation->equity_type ?? null,
            'total_investment' => $this->total_number_share_warrant ?? null,
            'access_type' => null,
            'country' => [
                'name' => $this->companyInformation->country->name ?? null,
                'code' => $this->companyInformation->country->code ?? null,
                'currency' => $this->companyInformation->country->currency ?? null,
            ],
        ];
    }
}
