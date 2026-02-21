<?php

namespace App\Modules\Auth\Actions\Login;

use App\Core\Results\ActionResult;
use App\Modules\Auth\DTO\LoginContext;

class IssueTokenAction
{
    public function execute(LoginContext $context): ActionResult
    {
        $device = request()->userAgent() ?? 'unknown';

        $context->token = $context->user
            ->createToken($device)
            ->plainTextToken;

        return ActionResult::success();
    }
}
