<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * Get posts
     * @param $perPage
     * @param $page
     * @param $topicId
     * @return mixed
     */
    public function getPosts($perPage, $page, $topicId = null)
    {
        return $this->model
            ->when($topicId, function ($q) use($topicId){
                return $q->where('topic_id', $topicId);
            })
            ->with(['user', 'Topic'])
            ->withCount(['comments', 'votes'])
            ->where('is_published', 1)
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    /**
     * Show post
     * @param $id
     * @return mixed
     */
    public function showPost($id)
    {
        return $this->model
            ->with(['user', 'Topic', 'comments.replies.parent', 'comments' => function($query) {
                $query->orderBy('id', 'DESC');
            }])
            ->withCount(['comments', 'votes'])
            ->where('id', $id)
            ->firstOrFail();
    }
}
