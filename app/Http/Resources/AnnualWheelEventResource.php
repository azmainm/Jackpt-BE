<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnualWheelEventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'start_date' => $this->start_date ?? null,
            'end_date' => $this->end_date ?? null,
            'start_time' => $this->start_time ?? null,
            'end_time' => $this->end_time ?? null,
            'start_year' => $this->start_year ?? null,
            'end_year' => $this->end_year ?? null,
            'event_title' => $this->event_title ?? null,
            'event_type' => $this->event_type ?? null,
            'location' => $this->location ?? null,
            'description' => $this->description ?? null,
            'week_number' => $this->week_number ?? null,
            'ring_type' => $this->ring_type ?? null,
            'activity_type' => $this->activity_type ?? null,
            'is_full_day' => $this->is_full_day ?? null,
            'is_recurring' => $this->is_recurring ?? null,
            'event_date' => $this->getDateRange(start_date: $this->start_date, end_date: $this->end_date),
            'participants' => $this->participants ?? null,
            'participants_count' => $this->participants ? count($this->participants) : null,

        ];
    }

    private function getDateRange(string $start_date, string $end_date): string
    {
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);

        return $start->format('M d').' - '.$end->format('d').', '.$end->format('Y');

    }
}
