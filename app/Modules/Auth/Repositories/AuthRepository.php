<?php

namespace App\Modules\Auth\Repositories;

use App\Core\Base\BaseRepository;
use App\Models\User;
use App\Modules\Auth\Interfaces\AuthRepositoryInterface;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}