<?php

namespace App\Repositories\PostVote;


use App\Repositories\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostVoteRepositoryInterface extends BaseRepositoryInterface
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
