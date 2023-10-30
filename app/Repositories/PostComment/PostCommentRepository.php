<?php

namespace App\Repositories\PostComment;

use App\Models\PostComment;
use App\Repositories\BaseRepository;

class PostCommentRepository extends BaseRepository implements PostCommentRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param PostComment $model
     */
    public function __construct(PostComment $model)
    {
        parent::__construct($model);
    }

    /**
     * Get user comments
     * @param $perPage
     * @param $page
     * @param $userId
     * @param array $orderByColumns
     * @return mixed
     */
    public function getUserComments($perPage, $page, $userId = null, array $orderByColumns = [])
    {
        $this->order($orderByColumns);
        return $this->model
            ->with('votes', 'replies', 'post', 'post.user')
            ->where('user_id', $userId)
            ->where('is_published', 1)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
