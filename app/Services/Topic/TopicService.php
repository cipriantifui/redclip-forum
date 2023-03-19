<?php

namespace App\Services\Topic;


use App\Http\Resources\TopicResource;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Services\BaseService;

class TopicService extends BaseService implements TopicServiceInterface
{
    /**
     * TopicService constructor.
     * @param TopicRepositoryInterface $repository
     */
    public function __construct(TopicRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function getTopics(int $perPage, int $page, array $orderByColumns)
    {
        return TopicResource::collection($this->repository->getTopics($perPage, $page, $orderByColumns));
    }
}
