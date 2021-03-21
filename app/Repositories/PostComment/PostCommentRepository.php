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

}
