<?php

namespace App\DataTransferObjects;
use App\Http\Requests\CreateBookingDiscountRequest;
use Carbon\Carbon;

class CreateBookingDiscountDto {
    public function __construct(
        public readonly string $description,
        // public readonly string $type,
        public readonly int $discount_amount,
        public readonly int $invert,
        public readonly float $rule

    ) {}

    public static function fromRequest(CreateBookingDiscountRequest $request) {
        return new self(
            description: $request->validated('description'),
            // type: $request->validated('type'),
            rule: $request->validated('rule'),
            discount_amount: $request->validated('discount_amount'),
            invert: $request->validated('invert'),
        );
    }
}
