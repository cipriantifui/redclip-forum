<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostCommentRequest;
use App\Services\PostComment\PostCommentServiceInterface;

class PostCommentController extends Controller
{
    private $postCommentService;

    /**
     * PostCommentController constructor.
     * @param PostCommentServiceInterface $postCommentService
     */
    public function __construct(PostCommentServiceInterface $postCommentService)
    {
        $this->postCommentService = $postCommentService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePostCommentRequest $request)
    {
        return $this->postCommentService->storeComment($request);
    }
}
