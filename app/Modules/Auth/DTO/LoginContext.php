<?php

namespace App\Modules\Auth\DTO;

class LoginContext
{
    public array $credentials;

    public $user = null;

    public ?string $token = null;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }
}