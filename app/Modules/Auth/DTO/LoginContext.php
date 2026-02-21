<?php

namespace App\Modules\Auth\DTO;

use App\Models\User;

class LoginContext
{
    public array $credentials;

    public ?User $user = null;

    public ?string $token = null;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }
}
