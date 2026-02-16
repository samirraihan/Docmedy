<?php

namespace App\Modules\Auth\Repositories;

use App\Models\User;

class AuthRepository
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
