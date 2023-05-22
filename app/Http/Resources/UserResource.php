<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->uuid,
            'status' => $this->status ?? null,
            'name' => $this->name ?? null,
            'email' => $this->email ?? null,
        ];
    }
}
