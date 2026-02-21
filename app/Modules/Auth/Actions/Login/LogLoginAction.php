<?php

namespace App\Modules\Auth\Actions\Login;

use App\Models\LoginLog;
use App\Modules\Auth\DTO\LoginContext;

class LogLoginAction
{
    public function execute(LoginContext $context): void
    {
        LoginLog::create([
            'user_id' => $context->user->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'logged_in_at' => now(),
        ]);
    }
}