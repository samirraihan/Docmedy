<?php

namespace App\Modules\Auth\Actions\Login;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class CheckRateLimitAction
{
    protected int $maxAttempts = 5;
    protected int $decaySeconds = 60;

    public function execute(): void
    {
        $key = $this->throttleKey();

        // Too many attempts?
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {

            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => [
                    "Too many login attempts. Try again in {$seconds} seconds."
                ]
            ]);
        }

        // Count this attempt
        RateLimiter::hit($key, $this->decaySeconds);
    }

    protected function throttleKey(): string
    {
        return strtolower(request('email')) . '|' . request()->ip();
    }
}
