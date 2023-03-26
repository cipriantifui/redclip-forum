<?php

namespace App\Services\Topic;


use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Services\BaseService;
use App\Traits\CommonTrait;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TopicService extends BaseService implements TopicServiceInterface
{
    use CommonTrait;
    /**
     * TopicService constructor.
     * @param TopicRepositoryInterface $repository
     */
    public function __construct(TopicRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get topics resource with paginate and orders
     * @param int $perPage
     * @param int $page
     * @param array $orderByColumns
     * @return AnonymousResourceCollection
     */
    public function getTopics(int $perPage, int $page, array $orderByColumns)
    {
        $arrOrderByColumns = $this->buildOrderFilter($orderByColumns);
        $topics = $this->repository->getTopics($perPage, $page, $arrOrderByColumns);
        $topics = $this->collectionFilter($topics, $arrOrderByColumns, new Topic);
        return TopicResource::collection($topics);
    }

    /**
     * Get specific topic resource
     * @param int $id
     * @return TopicResource
     */
    public function getTopic(int $id): TopicResource
    {
        return new TopicResource($this->repository->getTopic($id));
    }
}
