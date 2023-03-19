<?php


namespace App\Repositories\Topic;


use App\Models\Topic;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    /**
     * UserRepository constructor.
     * @param Topic $model
     */
    public function __construct(Topic $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $perPage
     * @param int $page
     * @param array $orderByColumns
     * @return LengthAwarePaginator
     */
    public function getTopics(int $perPage, int $page, array $orderByColumns): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $this->order($orderByColumns);
        return $this->model
        ->with(['posts' => function($q) {
            $q->where('is_published', 1);
        }, 'posts.user'])
        ->withCount(['posts'])
        ->where('active', 1)
        ->paginate($perPage);
    }
}
