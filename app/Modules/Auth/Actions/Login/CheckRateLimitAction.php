<?php

namespace App\Modules\Auth\Actions\Login;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Modules\Auth\DTO\LoginContext;

class CheckRateLimitAction
{
    protected int $maxAttempts = 5;
    protected int $decaySeconds = 60;

    public function execute(LoginContext $context): void
    {
        $key = $this->throttleKey($context);

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {

            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => [
                    "Too many login attempts. Try again in {$seconds} seconds."
                ]
            ]);
        }

        RateLimiter::hit($key, $this->decaySeconds);
    }

    protected function throttleKey(LoginContext $context): string
    {
        return strtolower($context->credentials['email'])
            . '|' . request()->ip();
    }
}
