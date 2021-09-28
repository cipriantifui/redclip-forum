<?php

namespace App\Services\Post;


use App\Services\BaseServiceInterface;

interface PostServiceInterface extends BaseServiceInterface
{
    /**
     * Get posts
     * @param $perPage
     * @param $page
     * @param $topicId
     * @return mixed
     */
    public function getPosts($perPage, $page, $topicId);

    /**
     * Store post in database
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePost($params);

    /**
     * Store content post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeContentPost($request);

    /**
     * Store video post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeVideoPost($request);

    /**
     * Store image post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeImagePost($request);

    /**
     * Show post
     * @param $id
     * @return mixed
     */
    public function showPost($id);
}
