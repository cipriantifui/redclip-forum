<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostVoteRequest;
use App\Services\PostVote\PostVoteServiceInterface;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    /**
     * @var PostVoteServiceInterface
     */
    private $postVoteService;

    /**
     * PostVoteController constructor.
     * @param PostVoteServiceInterface $postVoteService
     */
    public function __construct(PostVoteServiceInterface $postVoteService)
    {
        $this->postVoteService = $postVoteService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostVoteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostVoteRequest $request)
    {
        return $this->postVoteService->storePostVote($request);
    }
}
