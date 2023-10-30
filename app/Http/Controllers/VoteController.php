<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostVoteRequest;
use App\Services\PostVote\VoteServiceInterface;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * @var VoteServiceInterface
     */
    private $postVoteService;

    /**
     * VoteController constructor.
     * @param VoteServiceInterface $postVoteService
     */
    public function __construct(VoteServiceInterface $postVoteService)
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
