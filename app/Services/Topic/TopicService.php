<?php

namespace App\Services\Topic;


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

}
