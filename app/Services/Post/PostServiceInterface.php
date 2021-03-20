<?php

namespace App\Services\Post;


use App\Services\BaseServiceInterface;

interface PostServiceInterface extends BaseServiceInterface
{
    /**
     * Store post in database
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePost($params);
}
