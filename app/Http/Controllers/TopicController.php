<?php

namespace App\Http\Controllers;


use App\Http\Requests\topic\IndexPaginatedRequest;
use App\Services\Topic\TopicServiceInterface;

class TopicController extends Controller
{
    /**
     * @var TopicServiceInterface
     */
    private $topicService;

    /**
     * TopicController constructor.
     * @param TopicServiceInterface $topicService
     */
    public function __construct(TopicServiceInterface $topicService)
    {
        $this->topicService = $topicService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->topicService->index();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTopics(IndexPaginatedRequest $request)
    {
        return $this->topicService->getTopics(
            $request->input('perPage', 20),
            $request->input('page', 1),
            $request->input('orderByColumns', [])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->topicService->getTopic($id);
    }
}
