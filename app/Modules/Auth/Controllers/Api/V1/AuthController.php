<?php

namespace App\Modules\Auth\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Core\Responses\ApiResponse;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Requests\V1\LoginRequest;
use App\Modules\Auth\Resources\V1\AuthUserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected AuthService $service
    ) {}

    /**
     * Login
     *
     * User login endpoint.
     *
     * @group Auth
     */
    public function login(LoginRequest $request)
    {
        $result = $this->service->login(
            $request->validated()
        );

        return $this->success([
            'user' => new AuthUserResource($result['user']),
            'token' => $result['token']
        ], 'Login successful');
    }

    /**
     * Logout
     *
     * Logout authenticated user.
     *
     * @group Auth
     * @authenticated
     */
    public function logout(Request $request)
    {
        $this->service->logout($request->user());

        return $this->success(null, 'Logged out');
    }

    /**
     * Forgot Password
     *
     * Send password reset link / OTP.
     *
     * @group Auth
     */
    public function forgotPassword(Request $request)
    {
        $this->service->forgotPassword($request->email);

        return $this->success(null, 'Reset instructions sent');
    }

    /**
     * Reset Password
     *
     * Reset user password.
     *
     * @group Auth
     */
    public function resetPassword(Request $request)
    {
        $this->service->resetPassword($request->all());

        return $this->success(null, 'Password reset successful');
    }
}
