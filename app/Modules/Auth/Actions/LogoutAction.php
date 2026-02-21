<?php

namespace App\Modules\Auth\Actions;

class LogoutAction
{
    public function execute($user)
    {
        $user->currentAccessToken()->delete();
    }
}
