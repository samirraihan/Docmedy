<?php

namespace App\Modules\Auth\Actions\Login;

use App\Modules\Auth\DTO\LoginContext;

class ValidateRoleAction
{
    public function execute(LoginContext $context): void
    {
        if (!$context->user->hasAnyRole([
            'super_admin',
            'admin',
            'doctor',
            'registerer'
        ])) {
            abort(403, 'Unauthorized role');
        }
    }
}
