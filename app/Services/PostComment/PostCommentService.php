<?php

namespace App\Services\PostComment;


use App\Repositories\PostComment\PostCommentRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class PostCommentService extends BaseService implements PostCommentServiceInterface
{
    /**
     * TopicService constructor.
     * @param PostCommentRepositoryInterface $repository
     */
    public function __construct(PostCommentRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store comment
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeComment($request)
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        $this->repository->store([
            'post_id' => $request->get('post_id'),
            'user_id' => $userId,
            'parent_id' => $request->get('parent_id'),
            'uid' => $request->get('uid'),
            'content' => $request->get('content'),
            'is_published' => 1
        ]);

        return $this->item(['success' => true], 201);
    }
}
