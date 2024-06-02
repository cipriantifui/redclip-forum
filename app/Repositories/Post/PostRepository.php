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
     * @param null $topicId
     * @param array $orderByColumns
     * @return mixed
     */
    public function getPosts($perPage, $page, $topicId = null, array $orderByColumns = [])
    {
        $this->order($orderByColumns);
        return $this->model
            ->when($topicId, function ($q) use($topicId){
                return $q->where('topic_id', $topicId);
            })
            ->with(['user', 'topic'])
            ->withCount(['comments', 'votes'])
            ->where('is_published', 1)
            ->orderBy('id', 'desc')
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
            ->with(['user', 'topic', 'comments.replies.parent', 'comments' => function($query) {
                $query->orderBy('id', 'DESC');
            }])
            ->withCount(['comments', 'votes'])
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param $searchText
     * @param $perPage
     * @return mixed
     */
    public function searchPosts($searchText)
    {
        return $this->model->search($searchText)
            ->where('is_published', 1)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * Get user posts
     * @param $perPage
     * @param $page
     * @param null $userId
     * @param array $orderByColumns
     * @return mixed
     */
    public function getUserPosts($perPage, $page, $userId = null, array $orderByColumns = [])
    {
        $this->order($orderByColumns);
        return $this->model
            ->where('user_id', $userId)
            ->with('topic', 'user')
            ->withCount(['comments', 'votes'])
            ->where('is_published', 1)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
