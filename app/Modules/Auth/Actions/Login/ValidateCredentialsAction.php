<?php

namespace App\Modules\Auth\Actions\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Core\Results\ActionResult;
use App\Modules\Auth\DTO\LoginContext;

class ValidateCredentialsAction
{
    public function execute(LoginContext $context): ActionResult
    {
        if (!Auth::attempt($context->credentials)) {
            return ActionResult::fail('Invalid credentials');
        }

        RateLimiter::clear(
            strtolower($context->credentials['email'])
                . '|' . request()->ip()
        );

        $context->user = Auth::user();

        return ActionResult::success();
    }
}
