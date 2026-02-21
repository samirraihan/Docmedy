<?php

namespace App\Modules\Auth\Actions\Login;

use App\Core\Results\ActionResult;
use App\Modules\Auth\DTO\LoginContext;

class ValidateBranchAction
{
    public function execute(LoginContext $context): ActionResult
    {
        if (!$context->user->branches()->exists()) {
            return ActionResult::fail('No branch assigned');
        }

        return ActionResult::success();
    }
}
