<?php

namespace App\Modules\Auth\Actions\Login;

use App\Modules\Auth\DTO\LoginContext;

class IssueTokenAction
{
    public function execute(LoginContext $context): void
    {
        $device = request()->userAgent() ?? 'unknown';

        $context->token = $context->user
            ->createToken($device)
            ->plainTextToken;
    }
}
