<?php

namespace App\Services\PostCommentLike;


use App\Services\BaseServiceInterface;

interface PostCommentLikeServiceInterface extends BaseServiceInterface
{
    /**
     * Store comment like
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLike($request);
}
