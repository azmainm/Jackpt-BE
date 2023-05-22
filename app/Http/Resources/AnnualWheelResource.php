<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnualWheelResource extends JsonResource
{
    /**
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'wheel_name' => $this->wheel_name ?? null,
            'wheel_type' => $this->wheel_type ?? null,
            'company_id' => $this->company_id ?? null,
            'events' => 'test',
        ];
    }
}
