<?php

namespace App\Services\Search;

use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\Post\PostServiceInterface;
use App\Services\Users\UserServiceInterface;

class SearchService implements SearchServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postService;
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param PostServiceInterface $postService
     * @param UserServiceInterface $userService
     */
    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }
    /**
     * Get users and posts for with search scout
     * @param $searchText
     * @return array
     */
    public function getUsersAndPosts($searchText)
    {
        return [
            'posts' => $this->postService->searchPosts($searchText),
            'users' => $this->userService->searchUser($searchText)
        ];
    }
}
