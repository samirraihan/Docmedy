<?php

namespace App\Modules\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use App\Modules\Auth\Interfaces\AuthRepositoryInterface;

class LoginAction
{
    public function __construct(
        protected AuthRepositoryInterface $repo
    ) {}

    public function execute(array $data)
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
}
