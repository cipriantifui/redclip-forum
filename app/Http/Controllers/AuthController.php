<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    private $authService;

    /**
     * AuthController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register user
     * @bodyParam name string required . The name of the user. Example: test
     * @bodyParam email string required . The email of the user. Example: test@test.com
     * @bodyParam password string required . The password of the user. Example: asd123
     * @param RegisterRequest $request
     * @return mixed
     */
    public function postRegister(RegisterRequest $request)
    {
        return $this->authService->userRegister($request->only(['name', 'email', 'password']));
    }

    /**
     * Calls the service in order to attempt a login
     * @bodyParam email string required . The email of the user. Example: test@test.com
     * @bodyParam password string required . The password of the user. Example: asd123
     * @param LoginRequest $request
     * @return mixed
     * @throws \App\Exceptions\AuthException
     */
    public function postLogin(LoginRequest $request)
    {
        return $this->authService->userLogin($request->only('email', 'password'));
    }

    /**
     * Calls the service to fire a logout a user
     * @return mixed
     */
    public function logout()
    {
        return $this->authService->userLogout();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPasswordSendEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status === Password::RESET_LINK_SENT) {
            return response()->json(['status' => __($status)]);
        } else {
            return response()->json(['email' => __($status)], 422);
        }
    }

    public function resetPassword(Request $request)
    {
        dd(1);
    }
}
