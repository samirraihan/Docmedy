<?php

namespace App\Modules\Auth\Actions\Login;

use App\Modules\Auth\DTO\LoginContext;

class ValidateBranchAction
{
    public function execute(LoginContext $context): void
    {
        if (!$context->user->branches()->exists()) {
            abort(403, 'No branch assigned');
        }
    }
}
