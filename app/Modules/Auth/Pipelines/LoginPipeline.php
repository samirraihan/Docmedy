<?php

namespace App\Modules\Auth\Pipelines;

use Illuminate\Support\Facades\DB;
use App\Events\UserLoggedIn;
use App\Core\Results\ActionResult;
use App\Modules\Auth\DTO\LoginContext;

use App\Modules\Auth\Actions\Login\CheckRateLimitAction;
use App\Modules\Auth\Actions\Login\ValidateCredentialsAction;
use App\Modules\Auth\Actions\Login\ValidateRoleAction;
use App\Modules\Auth\Actions\Login\ValidateBranchAction;
use App\Modules\Auth\Actions\Login\IssueTokenAction;

class LoginPipeline
{
    public function __construct(
        protected CheckRateLimitAction $rateLimit,
        protected ValidateCredentialsAction $credentials,
        protected ValidateRoleAction $role,
        protected ValidateBranchAction $branch,
        protected IssueTokenAction $token,
    ) {}

    public function execute(array $data): ActionResult
    {
        return DB::transaction(function () use ($data) {

            $context = new LoginContext($data);

            foreach (
                [
                    $this->rateLimit,
                    $this->credentials,
                    $this->role,
                    // $this->branch,
                    $this->token,
                ] as $action
            ) {

                $result = $action->execute($context);

                if (!$result->success) {
                    return $result;
                }
            }

            event(new UserLoggedIn($context->user));

            return ActionResult::success([
                'user' => $context->user,
                'token' => $context->token
            ]);
        });
    }
}
