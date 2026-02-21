<?php

namespace App\Modules\Auth\Actions\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Modules\Auth\DTO\LoginContext;

class ValidateCredentialsAction
{
    public function execute(LoginContext $context): void
    {
        if (!Auth::attempt($context->credentials)) {
            abort(401, 'Invalid credentials');
        }

        RateLimiter::clear(
            strtolower($context->credentials['email'])
                . '|' . request()->ip()
        );

        $context->user = Auth::user();
    }
}
