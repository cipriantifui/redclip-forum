<?php

namespace App\Repositories\PostVote;

use App\Models\Vote;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VoteRepository extends BaseRepository implements VoteRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param Vote $model
     */
    public function __construct(Vote $model)
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
            ->with('votable')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
