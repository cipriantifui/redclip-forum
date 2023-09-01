<?php

namespace App\Http\Controllers;

use App\Services\Users\UserServiceInterface;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserPostDetails($id)
    {
        return $this->userService->getUserPostDetails($id);
    }
}
