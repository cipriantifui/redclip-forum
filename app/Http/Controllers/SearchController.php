<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\GetUsersAndPostsRequest;
use App\Services\Search\SearchServiceInterface;

class SearchController extends Controller
{
    /**
     * @var SearchServiceInterface
     */
    private $searchService;

    /**
     * @param SearchServiceInterface $searchService
     */
    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Search for users and posts resources
     * @param GetUsersAndPostsRequest $request
     * @return array
     */
    public function getUsersAndPosts(GetUsersAndPostsRequest $request)
    {
        return $this->searchService->getUsersAndPosts($request->input('searchText'));
    }
}
