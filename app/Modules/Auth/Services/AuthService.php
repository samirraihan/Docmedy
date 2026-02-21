<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $repo
    ) {}

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return false;
        }

        $user = Auth::user();

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }

    public function forgotPassword($email)
    {
        // later OTP / mail integration
        return true;
    }

    public function resetPassword($data)
    {
        // implement token reset later
        return true;
    }
}
