<?php
namespace App\Repositories;

use App\DataTransferObjects\UserRegisterDto;
use App\DataTransferObjects\UserLoginDto;

interface UserRepositoryInterface {
    public function create(UserRegisterDto $dto);
    public function login(UserLoginDto $dto);
}
