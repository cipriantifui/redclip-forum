<?php

namespace App\Repositories\PostVote;

use App\Models\PostVote;
use App\Repositories\BaseRepository;

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

}
