<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\response;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidCredentialsException;
use App\DataTransferObjects\UserRegisterDto;
use App\DataTransferObjects\UserLoginDto;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function register(UserRegisterRequest $request)
    {
        return UserResource::make(
            $this->userService->create(
                UserRegisterDto::fromRequest($request)
            )
        );
    }

    public function login(UserLoginRequest $request)
    {
        try {
            return UserResource::make(
                $this->userService->login(
                    UserLoginDto::fromRequest($request)
                )
            );
        }
        catch(InvalidCredentialsException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
