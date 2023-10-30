<?php

namespace App\Http\Controllers;

use App\Services\Users\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function getUserDetails($id)
    {
        return $this->userService->getUserDetails($id);
    }

    /**
     * Get user post details.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getUserPostsDetails($id, Request $request)
    {
        $this->validate($request, [
            'section' => 'sometimes|in:posts,likes,comments'
        ]);
        $section = $request->input('section', 'posts');
        return $this->userService->getUserPostsDetails($id, $section);
    }

    /**
     * Live status.
     * @param $userId
     * @return JsonResponse
     */
    public function getLiveStatus($userId)
    {
        return $this->userService->getLiveStatus($userId);
    }
}
