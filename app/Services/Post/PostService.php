<?php

namespace App\Services\Post;


use App\Http\Resources\PostResource;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * Get posts
     * @param $perPage
     * @param $page
     * @param $topicId
     * @return mixed
     */
    public function getPosts($perPage, $page, $topicId)
    {
        return PostResource::collection($this->repository->getPosts($perPage, $page, $topicId));
    }

    /**
     * Store post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePost($request)
    {
        $userId = Auth::check() ? (Auth::user()->id ?? null) : null;
        $post = $this->repository->store([
            'topic_id' => $request->get('topic_id'),
            'user_id' => $request->get('uid') ? null : $userId,
            'uid' => $request->get('uid'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'url_image' => $request->get('url_image'),
            'url_video' => $request->get('url_video'),
            'is_published' => true,
        ]);
        $postResource = new PostResource($post->load(['user', 'topic']));
        return $this->item(['post' => $postResource], 201);
    }

    /**
     * Store content post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeContentPost($request)
    {
        $userId = Auth::check() ? (Auth::user()->id ?? null) : null;
        $post = $this->repository->store([
            'topic_id' => $request->get('topic_id'),
            'user_id' => $request->get('uid') ? null : $userId,
            'uid' => $request->get('uid'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'is_published' => true,
        ]);
        $postResource = new PostResource($post->load(['user', 'topic']));
        return $this->item(['post' => $postResource], 201);
    }

    /**
     * Store video post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeVideoPost($request)
    {
        $file = $request->file('file_video');
        $filename = $file->getClientOriginalName();
        $path = public_path().'/uploads/';
        $videoPath = '/uploads/'.$filename;
        $file->move($path, $filename);
        $userId = Auth::check() ? (Auth::user()->id ?? null) : null;

        $post = $this->repository->store([
            'topic_id' => $request->get('topic_id'),
            'user_id' => $request->get('uid') ? null : $userId,
            'uid' => $request->get('uid'),
            'title' => $request->get('title'),
            'url_video' => $videoPath,
            'is_published' => true,
        ]);
        $postResource = new PostResource($post->load(['user', 'topic']));
        return $this->item(['post' => $postResource], 201);
    }

    /**
     * Store image post in database
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeImagePost($request)
    {
        $file = $request->file('file_image');
        $filename = $file->getClientOriginalName();
        $path = public_path().'/uploads/image/';
        $imagePath = '/uploads/image/'.$filename;
        $file->move($path, $filename);
        $userId = Auth::check() ? (Auth::user()->id ?? null) : null;

        $post = $this->repository->store([
            'topic_id' => $request->get('topic_id'),
            'user_id' => $request->get('uid') ? null : $userId,
            'uid' => $request->get('uid'),
            'title' => $request->get('title'),
            'url_image' => $imagePath,
            'is_published' => true,
        ]);

        $postResource = new PostResource($post->load(['user', 'topic']));
        return $this->item(['post' => $postResource], 201);
    }

    /**
     * Show post
     * @param $id
     * @return mixed
     */
    public function showPost($id)
    {
        $post = $this->repository->showPost($id);
        return new PostResource($post);
    }

    /**
     * @param $searchText
     * @param $perPage
     * @return AnonymousResourceCollection
     */
    public function searchPosts($searchText)
    {
        return PostResource::collection($this->repository->searchPosts($searchText));
    }
}
