<?php

namespace App\Modules\Auth\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Core\Responses\ApiResponse;
use App\Modules\Auth\Requests\V1\LoginRequest;
use App\Modules\Auth\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected AuthService $service
    ) {}

    public function login(LoginRequest $request)
    {
        $result = $this->service->login($request->validated());

        if (!$result) {
            return $this->error('Invalid credentials',401);
        }

        return $this->success($result,'Login successful');
    }
}

