<?php

namespace App\Services\PostComment;


use App\Services\BaseServiceInterface;

interface PostCommentServiceInterface extends BaseServiceInterface
{
    /**
     * Store comment
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeComment($request);
}
