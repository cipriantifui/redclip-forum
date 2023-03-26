<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostImageRequest;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\PostVideoRequest;
use App\Http\Requests\Post\ShowRequest;
use App\Services\Post\PostServiceInterface;

class PostController extends Controller
{
    /**
     * @var PostServiceInterface
     */
    private $postService;

    /**
     * PostController constructor.
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ShowRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ShowRequest $request)
    {
        return $this->postService->getPosts(
            $request->input('perPage', 20),
            $request->input('page', 1),
            $request->input('topic_id')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        return $this->postService->storePost($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeContentPost(PostRequest $request)
    {
        return $this->postService->storeContentPost($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeVideoPost(PostVideoRequest $request)
    {
        return $this->postService->storeVideoPost($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeImagePost(PostImageRequest $request)
    {
        return $this->postService->storeImagePost($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->postService->showPost($id);
    }

}
