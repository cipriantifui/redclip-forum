<?php

namespace App\Services\Search;

use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\Post\PostServiceInterface;
use App\Services\Users\UserServiceInterface;
use App\Traits\ApiResponses\ApiResponses;

class SearchService implements SearchServiceInterface
{
    use ApiResponses;
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
        $response = [
            'posts' => $this->postService->searchPosts($searchText),
            'users' => $this->userService->searchUser($searchText)
        ];

        return $this->collection($response);
    }
}
