<?php

namespace App\DataTransferObjects;
use App\Http\Requests\CreateBookingRequest;
use Carbon\Carbon;

class CreateBookingDto {
    public function __construct(
        public readonly int $event_id,
        public readonly Carbon $booking_date,
        public readonly string $guest_name,
        public readonly string $guest_email,
        public readonly array $prices

    ) {}

    public static function fromRequest(CreateBookingRequest $request) {
        return new self(
            event_id: $request->validated('event_id'),
            booking_date: Carbon::parse($request->validated('booking_date')),
            guest_name: $request->validated('guest_name'),
            guest_email: $request->validated('guest_email'),
            prices: $request->validated('prices')
        );
    }
}
