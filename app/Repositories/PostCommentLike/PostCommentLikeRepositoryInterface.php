<?php

namespace App\Repositories\PostCommentLike;


use App\Repositories\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostCommentLikeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $perPage
     * @param $page
     * @param $userId
     * @param array $orderByColumns
     * @return LengthAwarePaginator
     */
    public function getUserLikes($perPage, $page, $userId = null, array $orderByColumns = []);
}
