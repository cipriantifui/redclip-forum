<?php

namespace App\Repositories\Post;


use App\Repositories\BaseRepositoryInterface;

interface PostRepositoryInterface extends BaseRepositoryInterface
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
     * Show post
     * @param $id
     * @return mixed
     */
    public function showPost($id);
}
