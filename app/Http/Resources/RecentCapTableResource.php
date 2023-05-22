<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecentCapTableResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->uuid,
            'user_id' => $this->user_id,
            'is_published' => $this->is_published ?? null,
            'company_name' => $this->companyInformation->name ?? null,
            'incorporation_date' => $this->companyInformation->incorporation_date ?? null,
            //            'role' => $this->role ?? 'N/A',
            //            'share' => $this->share ?? 'N/A',
            'country' => [
                'name' => $this->companyInformation->country->name ?? null,
                'code' => $this->companyInformation->country->code ?? null,
            ],
        ];
    }
}
