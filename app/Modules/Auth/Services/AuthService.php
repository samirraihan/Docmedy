<?php

namespace App\Modules\Auth\Services;

use Illuminate\Support\Facades\Auth;
use App\Modules\Auth\Repositories\AuthRepository;

class AuthService
{
    public function __construct(
        protected AuthRepository $repo
    ) {}

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return false;
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
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
