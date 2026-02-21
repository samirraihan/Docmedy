<?php

namespace App\Modules\Auth\Actions\Login;

class ValidateRoleAction
{
    public function execute($user): void
    {
        if (!$user->hasAnyRole([
            'super_admin',
            'admin',
            'doctor',
            'registerer'
        ])) {
            abort(403, 'Unauthorized role');
        }
    }
}