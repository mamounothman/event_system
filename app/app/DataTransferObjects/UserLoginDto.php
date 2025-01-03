<?php

namespace App\DataTransferObjects;
use App\Http\Requests\UserLoginRequest;
use Carbon\Carbon;

class UserLoginDto {
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromRequest(UserLoginRequest $request) {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password')
        );
    }
}
