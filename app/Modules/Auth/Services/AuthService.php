<?php

namespace App\Modules\Auth\Services;

use App\Core\Base\BaseService;
use App\Modules\Auth\Actions\ForgotPasswordAction;
use App\Modules\Auth\Actions\LoginAction;
use App\Modules\Auth\Actions\LogoutAction;
use App\Modules\Auth\Actions\ResetPasswordAction;

class AuthService extends BaseService
{
    public function __construct(
        protected LoginAction $loginAction,
        protected LogoutAction $logoutAction,
        protected ForgotPasswordAction $forgotPasswordAction,
        protected ResetPasswordAction $resetPasswordAction,
    ) {}

    public function login(array $data)
    {
        return $this->loginAction->execute($data);
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
