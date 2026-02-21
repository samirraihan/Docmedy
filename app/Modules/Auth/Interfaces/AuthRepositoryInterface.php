<?php

namespace App\Modules\Auth\Interfaces;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email);

    public function create(array $data);
}