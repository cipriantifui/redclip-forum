<?php


namespace App\Repositories\Topic;


use App\Models\Topic;
use App\Repositories\BaseRepository;

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

}
