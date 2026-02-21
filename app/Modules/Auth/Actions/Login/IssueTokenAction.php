<?php

namespace App\Modules\Auth\Actions\Login;

class IssueTokenAction
{
    public function execute($user)
    {
        $device = request()->userAgent() ?? 'unknown';

        return [
            'user' => $user,
            'token' => $user
                ->createToken($device)
                ->plainTextToken
        ];
    }
}