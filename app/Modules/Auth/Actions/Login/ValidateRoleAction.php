<?php

namespace App\Modules\Auth\Actions\Login;

use App\Core\Results\ActionResult;
use App\Modules\Auth\DTO\LoginContext;

class ValidateRoleAction
{
    public function execute(LoginContext $context): ActionResult
    {
        if (!$context->user->hasAnyRole([
            'super_admin',
            'admin',
            'doctor',
            'registerer'
        ])) {
            return ActionResult::fail('Unauthorized role');
        }

        return ActionResult::success();
    }
}
