<?php

namespace App\Http\Controllers;


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

}
