<?php

namespace App\Modules\Auth\Services;

use App\Core\Base\BaseService;
use App\Modules\Auth\Actions\ForgotPasswordAction;
use App\Modules\Auth\Actions\LogoutAction;
use App\Modules\Auth\Actions\ResetPasswordAction;
use App\Modules\Auth\Pipelines\LoginPipeline;

class AuthService extends BaseService
{
    public function __construct(
        protected LoginPipeline $loginPipeline,
        protected LogoutAction $logoutAction,
        protected ForgotPasswordAction $forgotPasswordAction,
        protected ResetPasswordAction $resetPasswordAction,
    ) {}

    public function login(array $data)
    {
        return $this->loginPipeline->execute($data);
    }

    public function logout($user): void
    {
        $this->logoutAction->execute($user);
    }

    public function forgotPassword($email)
    {
        return $this->forgotPasswordAction->execute($email);
    }

    public function resetPassword($data)
    {
        return $this->resetPasswordAction->execute($data);
    }
}
