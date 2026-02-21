<?php

namespace App\Modules\Auth\Actions\Login;

class ValidateBranchAction
{
    public function execute($user): void
    {
        if (!$user->branches()->exists()) {
            abort(403, 'No branch assigned');
        }
    }
}