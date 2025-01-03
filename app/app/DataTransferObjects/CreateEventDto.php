<?php

namespace App\DataTransferObjects;
use App\Http\Requests\CreateEventRequest;
// use App\DataTransferObjects\TickeTypeDto;
use Carbon\Carbon;

class CreateEventDto {
    public function __construct(
        public readonly int $user_id,
        public readonly string $title,
        public readonly string $description,
        public readonly int $capacity,
        public readonly Carbon $start_date,
        public readonly Carbon $end_date,
        public readonly int $status,
        public readonly array $prices,
        public readonly array $discounts,
    ) {}

    public static function fromRequest(CreateEventRequest $request) {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            capacity: $request->validated('capacity'),
            start_date: Carbon::parse($request->validated('start_date')),
            end_date: Carbon::parse($request->validated('end_date')),
            user_id: $request->user()->id,
            status: $request->validated('status'),
            prices: $request->validated('prices'),
            discounts: $request->validated('discounts')
        );
    }
}
