<?php


namespace App\Repositories\Users;


use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $searchText
     * @return mixed
     */
    public function searchUser($searchText)
    {
        return $this->model->search($searchText)
            ->where('active', 1)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserPostDetails($userId)
    {
        return $this->model
            ->where('id', $userId)
            ->withCount(['posts', 'comments', 'replies', 'postVotes', 'commentVotes'])
            ->first();
    }
}
