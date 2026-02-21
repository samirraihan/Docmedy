<?php

namespace App\Modules\Auth\Actions\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class ValidateCredentialsAction
{
    public function execute(array $data)
    {
        if (!Auth::attempt($data)) {
            abort(401, 'Invalid credentials');
        }

        RateLimiter::clear(
            strtolower($data['email']) . '|' . request()->ip()
        );

        return Auth::user();
    }
}
