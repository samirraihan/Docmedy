<?php

namespace App\Modules\Auth\Pipelines;

use App\Modules\Auth\DTO\LoginContext;
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
        // protected ValidateBranchAction $branch,
        protected IssueTokenAction $token,
        protected LogLoginAction $log
    ) {}

    public function execute(array $data)
    {
        $context = new LoginContext($data);

        $this->rateLimit->execute($context);
        $this->credentials->execute($context);
        $this->role->execute($context);
        // $this->branch->execute($context);
        $this->token->execute($context);
        $this->log->execute($context);

        return [
            'user' => $context->user,
            'token' => $context->token,
        ];
    }
}
