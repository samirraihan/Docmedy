<?php

namespace App\Modules\Auth\Pipelines;

use App\Modules\Auth\Actions\Login\CheckRateLimitAction;
use App\Modules\Auth\Actions\Login\ValidateCredentialsAction;
use App\Modules\Auth\Actions\Login\ValidateRoleAction;
use App\Modules\Auth\Actions\Login\ValidateBranchAction;
use App\Modules\Auth\Actions\Login\IssueTokenAction;
use App\Modules\Auth\Actions\Login\LogLoginAction;

class LoginPipeline
{
    public function __construct(
        protected CheckRateLimitAction $rateLimit,
        protected ValidateCredentialsAction $credentials,
        protected ValidateRoleAction $role,
        protected ValidateBranchAction $branch,
        protected IssueTokenAction $token,
        protected LogLoginAction $log
    ) {}

    public function execute(array $data)
    {
        $this->rateLimit->execute();

        $user = $this->credentials->execute($data);

        $this->role->execute($user);
        $this->branch->execute($user);

        $result = $this->token->execute($user);

        $this->log->execute($user);

        return $result;
    }
}