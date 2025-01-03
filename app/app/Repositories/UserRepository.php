<?php
namespace App\Repositories;

use App\DataTransferObjects\UserRegisterDto;
use App\DataTransferObjects\UserLoginDto;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface{

    public function __construct(protected User $model) {}

    public function create(UserRegisterDto $dto): User {
        return $this->model->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    public function login(UserLoginDto $dto): User {
        $credentials = ['email' => $dto->email,'password' => $dto->password];
        if (!Auth::attempt($credentials)) {
            throw new InvalidCredentialsException('Invalid credentials');
        }

        return Auth::user();
    }
}
