<?php

namespace App\DataTransferObjects;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserRegisterDto {
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromRequest(UserRegisterRequest $request) {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: Hash::make($request->validated('password'))
        );
    }
}
