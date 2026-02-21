<?php

namespace App\Modules\Auth\Actions\Login;

use App\Core\Results\ActionResult;
use Illuminate\Support\Facades\RateLimiter;
use App\Modules\Auth\DTO\LoginContext;

class CheckRateLimitAction
{
    protected int $maxAttempts = 5;
    protected int $decaySeconds = 60;

    public function execute(LoginContext $context): ActionResult
    {
        $key = strtolower($context->credentials['email'])
            . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            return ActionResult::fail('Too many login attempts');
        }

        RateLimiter::hit($key, $this->decaySeconds);

        return ActionResult::success();
    }
}
