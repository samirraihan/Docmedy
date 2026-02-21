<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\LoginLog;

class LogLoginListener
{
    public function handle(UserLoggedIn $event): void
    {
        LoginLog::create([
            'user_id' => $event->user->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'logged_in_at' => now(),
        ]);
    }
}
