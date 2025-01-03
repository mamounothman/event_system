<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\DataTransferObjects\UserRegisterDto;
use App\DataTransferObjects\UserLoginDto;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function create(UserRegisterDto $data): User
    {
        return $this->userRepository->create($data);
    }

    public function login(UserLoginDto $data): User
    {
        return $this->userRepository->login($data);
    }

}
