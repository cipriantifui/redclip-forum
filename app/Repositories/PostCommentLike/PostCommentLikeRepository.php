<?php

namespace App\Repositories\PostCommentLike;


use App\Models\PostCommentLike;
use App\Repositories\BaseRepository;

class PostCommentLikeRepository extends BaseRepository implements PostCommentLikeRepositoryInterface
{
    /**
     * PostRepository constructor.
     * @param PostCommentLike $model
     */
    public function __construct(PostCommentLike $model)
    {
        parent::__construct($model);
    }

}
