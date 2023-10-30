<?php

namespace App\Repositories\PostVote;

use App\Models\PostVote;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostVoteRepository extends BaseRepository implements PostVoteRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param PostVote $model
     */
    public function __construct(PostVote $model)
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
            ->with('post')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
