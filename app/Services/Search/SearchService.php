<?php

namespace App\Services\Search;

use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\Post\PostService;

class SearchService implements SearchServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postService;

    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Get users and posts for with search scout
     * @param $searchText
     * @return void
     */
    public function getUsersAndPosts($searchText)
    {
        return [
            'posts' => $this->postService->searchPosts($searchText),
            'users' => []
        ];
    }
}
