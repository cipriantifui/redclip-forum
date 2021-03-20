<?php

namespace App\Services\Post;


use App\Repositories\Post\PostRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class PostService extends BaseService implements PostServiceInterface
{
    /**
     * TopicService constructor.
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePost($request)
    {
        $this->repository->store([
            'topic_id' => $request->get('topic_id'),
            'user_id' => $request->get('uid') ? null : Auth::user()->id,
            'uid' => $request->get('uid'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'url_image' => $request->get('url_image'),
            'url_video' => $request->get('url_video'),
            'is_published' => true,
        ]);

        return $this->item(['success' => true],201);
    }
}
