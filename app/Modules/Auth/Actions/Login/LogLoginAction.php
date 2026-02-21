<?php

namespace App\Modules\Auth\Actions\Login;

use App\Models\LoginLog;

class LogLoginAction
{
    public function execute($user): void
    {
        LoginLog::create([
            'user_id' => $user->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'logged_in_at' => now(),
        ]);
    }
}