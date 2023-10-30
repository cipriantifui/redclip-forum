<?php

namespace App\Repositories\PostComment;


use App\Repositories\BaseRepositoryInterface;

interface PostCommentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get user comments
     * @param $perPage
     * @param $page
     * @param $userId
     * @param array $orderByColumns
     * @return mixed
     */
    public function getUserComments($perPage, $page, $userId = null, array $orderByColumns = []);
}
