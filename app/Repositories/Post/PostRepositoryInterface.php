<?php

namespace App\Repositories\Post;


use App\Repositories\BaseRepositoryInterface;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get posts
     * @param $perPage
     * @param $page
     * @param null $topicId
     * @param array $orderByColumns
     * @return mixed
     */
    public function getPosts($perPage, $page, $topicId = null, array $orderByColumns);

    /**
     * Show post
     * @param $id
     * @return mixed
     */
    public function showPost($id);

    /**
     * @param $searchText
     * @param $perPage
     * @return mixed
     */
    public function searchPosts($searchText);
}
