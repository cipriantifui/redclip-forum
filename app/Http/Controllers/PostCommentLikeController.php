<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreCommentLikeVoteRequest;
use App\Services\PostCommentLike\PostCommentLikeServiceInterface;
use Illuminate\Http\Request;

class PostCommentLikeController extends Controller
{
    /**
     * @var PostCommentLikeServiceInterface
     */
    private $commentLikeService;

    /**
     * PostCommentLikeController constructor.
     * @param PostCommentLikeServiceInterface $commentLikeService
     */
    public function __construct(PostCommentLikeServiceInterface $commentLikeService)
    {
        $this->commentLikeService = $commentLikeService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentLikeVoteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentLikeVoteRequest $request)
    {
        return $this->commentLikeService->storeLike($request);
    }
}
