<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{

    //// public readonly int $total_price,
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event_id' => $this->event_id,
            'user_id' => $this->user_id,
            'booking_date' => $this->booking_date,
            'guest_name' => $this->guest_name,
            'guest_email' => $this->guest_email,
            'total_guests' => $this->total_guests,
            'total_price' => $this->total_price,
            'prices' => $this->prices,
            'discounts' => $this->event->discounts,
        ];
    }
}
