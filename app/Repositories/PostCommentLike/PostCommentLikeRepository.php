<?php

namespace App\Repositories\PostCommentLike;


use App\Models\PostCommentLike;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostCommentLikeRepository extends BaseRepository implements PostCommentLikeRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param PostCommentLike $model
     */
    public function __construct(PostCommentLike $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $perPage
     * @param $page
     * @param $userId
     * @param array $orderByColumns
     * @return LengthAwarePaginator
     */
    public function getUserLikes($perPage, $page, $userId = null, array $orderByColumns = [])
    {
        $this->order($orderByColumns);
        return $this->model
            ->with('comment')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
